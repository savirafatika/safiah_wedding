<?php

namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\BlogTagsModel;
use App\Models\TagModel;
use CodeIgniter\RESTful\ResourcePresenter;
use Config\Database;

class Blog extends ResourcePresenter
{
    protected $blog, $db;

    public function __construct()
    {
        $this->blog = new BlogModel();
        $this->db = Database::connect();
    }
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $data['title'] = 'Blog';
        $data['blog'] = $this->blog->findAll();

        $builder = $this->db->table('blog_tags as bt')->select('bt.*, tg.nama_tag')
            ->join('tag as tg', 'tg.id_tag = bt.tag_id')
            ->get();
        $data['tag'] = $builder->getResult();

        return view('blog/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $tag = new TagModel();
        $data['title'] = 'Tambah Blog';
        $data['tag'] = $tag->findAll();
        return view('blog/new', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        // lakukan validasi
        $rules = [
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required'
            ],
            'deskripsi_singkat' => [
                'label' => 'Deskripsi Singkat',
                'rules' => 'required'
            ],
            'thumbnail' => [
                'label' => 'Thumbnail',
                'rules' => [
                    'is_image[thumbnail]',
                    'mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                    'max_size[thumbnail,2048]',
                ],
                'errors' => [
                    'is_image' => 'Harus Berupa Gambar dengan Ekstensi jpg,jpeg,png',
                    'mime_in' => 'File Ekstensi Harus Berupa jpg,jpeg,png',
                    'max_size' => 'Ukuran File Maksimal 2 MB'
                ]
            ]
        ];

        // cek ada validasi tidak 
        if ($this->validate($rules)) {
            $fileImage_name = "placeholder.jpg";
            if (isset($_FILES) && @$_FILES['thumbnail']['error'] != '4') {
                if ($fileImage = $this->request->getFile('thumbnail')) {
                    if (!$fileImage->isValid()) {
                        throw new \RuntimeException($fileImage->getErrorString() . '(' . $fileImage->getError() . ')');
                    } else {
                        $fileImage_name = $fileImage->getRandomName();
                        $fileImage->move('images/thumbnail', $fileImage_name);
                    }
                }
            }

            $allowedPostFields = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi_singkat' => $this->request->getPost('deskripsi_singkat'),
                'isi' => $this->request->getPost('isi'),
                'thumbnail' => $fileImage_name
            ];

            $this->blog->save($allowedPostFields);
            $blog_id = $this->blog->getInsertID();

            $blogTags = new BlogTagsModel();
            if ($this->request->getPost('tag') !== null) {
                $nama_tags = count($this->request->getPost('tag'));

                for ($i = 0; $i < $nama_tags; $i++) {
                    $datas[$i] = array(
                        'blog_id' => $blog_id,
                        'tag_id' => $this->request->getPost('tag[' . $i . ']')
                    );

                    $blogTags->save($datas[$i]);
                }
            }

            // Success!
            session()->setFlashdata('message', 'Berhasil menambahkan blog baru');
            return redirect()->to(base_url('superadmin/blog'));
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id_blog = null)
    {
        $tagModel = new TagModel();
        $data['title'] = 'Edit Blog';
        $data['tagOption'] = $tagModel->findAll();
        $data['blog'] = $this->blog->where('id_blog', $id_blog)->first();
        $builder = $this->db->table('blog_tags as bt')->select('bt.tag_id')
            ->join('tag as tg', 'tg.id_tag = bt.tag_id')
            ->where('bt.blog_id', $id_blog)
            ->get();
        $tag_id = $builder->getResultArray();
        foreach ($tag_id as $t) {
            $data['tag'][] = $t['tag_id'];
        }
        // echo '<pre>';
        // print_r($data['tag']);
        // die;
        return view('blog/edit', $data);
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id_blog = null)
    {
        $id_blog =  $this->request->getVar('id_blog');

        // lakukan validasi
        $rules = [
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required'
            ],
            'deskripsi_singkat' => [
                'label' => 'Deskripsi Singkat',
                'rules' => 'required'
            ],
            'thumbnail' => [
                'label' => 'Thumbnail',
                'rules' => [
                    'is_image[thumbnail]',
                    'mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                    'max_size[thumbnail,2048]',
                ],
                'errors' => [
                    'is_image' => 'Harus Berupa Gambar dengan Ekstensi jpg,jpeg,png',
                    'mime_in' => 'File Ekstensi Harus Berupa jpg,jpeg,png',
                    'max_size' => 'Ukuran File Maksimal 2 MB'
                ]
            ]
        ];

        // cek ada validasi tidak 
        if ($this->validate($rules)) {
            $fileImage_name = $this->request->getVar('oldThumbnail');
            if (isset($_FILES) && @$_FILES['thumbnail']['error'] != '4') {
                if ($fileImage = $this->request->getFile('thumbnail')) {
                    if (!$fileImage->isValid()) {
                        throw new \RuntimeException($fileImage->getErrorString() . '(' . $fileImage->getError() . ')');
                    } else {
                        if ($fileImage_name !== 'placeholder.jpg') {
                            $path = 'images/thumbnail/';
                            unlink($path . $fileImage_name);
                        }
                        $fileImage_name = $fileImage->getRandomName();
                        $fileImage->move('images/thumbnail', $fileImage_name);
                    }
                }
            }

            $allowedPostFields = [
                'judul' => $this->request->getPost('judul'),
                'deskripsi_singkat' => $this->request->getPost('deskripsi_singkat'),
                'isi' => $this->request->getPost('isi'),
                'thumbnail' => $fileImage_name
            ];

            $this->blog->update($id_blog, $allowedPostFields);

            $blogTags = new BlogTagsModel();
            if ($this->request->getPost('tag') !== null) {
                $nama_tags = count($this->request->getPost('tag'));

                $blogTags->where('blog_id', $id_blog)->delete();
                for ($i = 0; $i < $nama_tags; $i++) {
                    $datas[$i] = array(
                        'blog_id' => $id_blog,
                        'tag_id' => $this->request->getPost('tag[' . $i . ']')
                    );

                    $blogTags->save($datas[$i]);
                }
            }

            session()->setFlashdata('message', 'Berhasil mengubah blog');
            return redirect()->to(base_url('superadmin/blog'));
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id_blog = null)
    {
        if ($id_blog != null && $id_blog > 0) {
            return $this->delete($id_blog);
        }
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id_blog = null)
    {
        $blogTags = new BlogTagsModel();
        $blog_data = $this->blog->where('id_blog', $id_blog)->first();
        $fileImage_name = $blog_data['thumbnail'];

        if ($fileImage_name !== 'placeholder.jpg') {
            unlink('images/thumbnail/' . $fileImage_name);
        }
        $blogTags->where('blog_id', $id_blog)->delete();
        $this->blog->where('id_blog', $id_blog)->delete();

        session()->setFlashdata('message', 'Berhasil menghapus blog');
        return redirect()->to(base_url('superadmin/blog'));
    }
}
