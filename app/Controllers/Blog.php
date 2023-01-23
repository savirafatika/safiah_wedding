<?php

namespace App\Controllers;

use App\Models\BlogModel;
use App\Models\BlogTagsModel;
use App\Models\TagModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Blog extends ResourcePresenter
{
    protected $blog;

    public function __construct()
    {
        $this->blog = new BlogModel();
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
        $rules = $this->blog->validationRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileImage_name = "img01.jpg";
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

        if (!$this->blog->save($allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->blog->errors());
        }
        $blog_id = $this->blog->getInsertID();

        $blogTags = new BlogTagsModel();
        $nama_tags = count($this->request->getPost('tag'));

        for ($i = 0; $i < $nama_tags; $i++) {
            $datas[$i] = array(
                'blod_id' => $blog_id,
                'tag_id' => $this->request->getPost('tag[' . $i . ']')
            );

            $blogTags->save($datas[$i]);
        }

        // Success!
        session()->setFlashdata('message', 'Berhasil menambahkan blog baru');
        return redirect()->to(base_url('superadmin/blog'));
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
        $data['title'] = 'Edit Blog';
        $data['blog'] = $this->blog->where('id_blog', $id_blog)->first();
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
        // lakukan validasi
        $rules = $this->blog->validatisonRules;

        // cek ada validasi tidak 
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileImage_name = $this->request->getVar('oldThumbnail');
        if (isset($_FILES) && @$_FILES['thumbnail']['error'] != '4') {
            if ($fileImage = $this->request->getFile('thumbnail')) {
                if (!$fileImage->isValid()) {
                    throw new \RuntimeException($fileImage->getErrorString() . '(' . $fileImage->getError() . ')');
                } else {
                    $path = 'images/thumbnail';
                    $fileImage_name = $fileImage->getName();
                    @unlink($path . $fileImage_name);
                    $fileImage->move('images/thumbnail');
                }
            }
        }

        $allowedPostFields = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi_singkat' => $this->request->getPost('deskripsi_singkat'),
            'isi' => $this->request->getPost('isi'),
            'thumbnail' => $fileImage_name
        ];

        if (!$this->blog->update($id_blog, $allowedPostFields)) {
            return redirect()->back()->withInput()->with('errors', $this->blog->errors());
        }

        session()->setFlashdata('message', 'Berhasil mengubah blog');
        return redirect()->to(base_url('superadmin/blog'));
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
        $this->tag->where('id_tag', $id_tag)->delete();

        session()->setFlashdata('message', 'Berhasil menghapus tag');
        return redirect()->to(base_url('superadmin/tag'));
    }
}
