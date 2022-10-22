<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\AppModel;
use App\Models\FileModel;
use \Geeklabs\Breadcrumbs\Breadcrumb;
use Google\Client;
use Google\Service\Drive;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\returnSelf;

class App extends BaseController
{
    public function __construct()
    {
        $this->breadcrumb = new Breadcrumb();
        $this->authModel = new AuthModel();
        $this->appModel = new AppModel();
        $this->fileModel = new FileModel();
    }
    public function link()
    {
        $data = [
            'desain' => $this->appModel->where('category', "Data Desain")->first(),
            'template' => $this->appModel->where('category', "Data Template")->first(),
            'agen' => $this->appModel->where('category', "Data Agen")->first(),
            'foto' => $this->appModel->where('category', "Data Foto")->first(),
            'video' => $this->appModel->where('category', "Data Video")->first(),
            'perusahaan' => $this->appModel->where('category', "Data Perusahaan")->first(),
        ];
        return view('link', $data);
    }
    public function linkRedirect()
    {
        $data = $this->request->getVar();
        $this->appModel->setClick($data['url']);
        header("Location: " . $data['url']);
        exit;
    }
    public function welcome()
    {
        $data = [
            'title' => 'Selamat Datang'
        ];
        return view('welcome', $data);
    }
    public function dashboard()
    {
        $jumlahLink = count($this->appModel->findAll());
        $jumlahKlik = $this->appModel->getClick();
        $jumlahUser = count($this->authModel->findAll());
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Dasbor',
            'link' => $jumlahLink,
            'klik' => $jumlahKlik,
            'user' => $jumlahUser
        ];
        return view('dasbor', $data);
    }
    public function listLink()
    {
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Daftar Link',
            'link' => $this->appModel->findAll()
        ];
        return view('listLink', $data);
    }
    public function deleteLink($id)
    {
        $this->appModel->delete($id);
        session()->setFlashdata('success_link', 'Data Berhasil Dihapus');
        return redirect()->to('/dasbor/link');
    }
    public function deleteUser($id)
    {
        $this->authModel->delete($id);
        session()->setFlashdata('success_user', 'Data Berhasil Dihapus');
        return redirect()->to('/dasbor/user');
    }
    public function updateLink($id)
    {
        $query = $this->appModel->where('id', $id)->first();
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Ubah Data Link',
            'link' => $query
        ];
        return view('updateLink', $data);
    }
    public function updateUser($id)
    {
        $query = $this->authModel->where('id', $id)->first();
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Ubah Data User',
            'user' => $query
        ];
        return view('updateUser', $data);
    }

    public function listUser()
    {
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Daftar User',
            'users' => $this->authModel->findAll()
        ];
        return view('listUser', $data);
    }
    public function listFile()
    {
        if (session()->get('role') == 3) {
            $file = $this->fileModel->getFileExcept();
        } else {
            $file = $this->fileModel->findAll();
        }

        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Daftar File',
            'file' => $file
        ];
        return view('listFile', $data);
    }
    public function addLink()
    {
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Tambah Link'
        ];
        return view('tambahLink', $data);
    }
    public function addUser()
    {
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Tambah User'
        ];
        return view('tambahUser', $data);
    }
    public function doAddUser()
    {
        $data = $this->request->getVar();
        $salt = uniqid('', true);
        $password = md5($data['pass']) . $salt;
        $this->authModel->save([
            'email' => $data['email'],
            'pass' => $password,
            'name' => $data['name'],
            'status' => 0,
            'salt' => $salt,
            'role' => $data['catUser']
        ]);
        session()->setFlashdata('success_user', 'User Berhasil Ditambahkan');
        return redirect()->to('/dasbor/user');
    }
    public function doUpdateUser()
    {
        $data = $this->request->getVar();
        $salt = uniqid('', true);
        $password = md5($data['pass']) . $salt;
        $this->authModel->update($data['id'], [
            'pass' => $password,
            'salt' => $salt
        ]);
        session()->setFlashdata('success_user', 'User Berhasil Diubah');
        return redirect()->to('/dasbor/user');
    }
    public function updateFile($id)
    {
        $query = $this->fileModel->where('id', $id)->first();
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Ubah Data File',
            'file' => $query
        ];
        return view('updateFile', $data);
    }
    public function addFolderDrive()
    {
        $data = $this->request->getVar();
        try {
            $client = new Client();
            $client->setAuthConfig(WRITEPATH . '/secrets/drivenutrifeed-dcc00319371b.json');
            $client->addScope(Drive::DRIVE);
            $driveService = new Drive($client);
            $fileMetadata = new Drive\DriveFile(array(
                'name' => $data['folder'],
                'mimeType' => 'application/vnd.google-apps.folder'
            ));
            $fileMetadata->setParents([$data['id']]);
            $file = $driveService->files->create($fileMetadata, array(
                'fields' => 'id'
            ));
            session()->setFlashdata('successUpload', 'Folder Berhasil Dibuat');
            return redirect()->back();
        } catch (\Exception $e) {
            echo "Error Message: " . $e;
        }
    }
    public function doUpdateFile()
    {
        $data = $this->request->getVar();
        try {
            $client = new Client();
            $client->setAuthConfig(WRITEPATH . '/secrets/drivenutrifeed-dcc00319371b.json');
            $client->addScope(Drive::DRIVE);
            $driveService = new Drive($client);
            $file = new Drive\DriveFile();
            $file->setName($data['name']);
            $driveService->files->update($data['id_file'], $file);
            $this->fileModel->update($data['id'], [
                'name' => $data['name']
            ]);
            session()->setFlashdata('successUpload', 'File Berhasil di Ubah');
            return redirect()->to('/dasbor/file');
        } catch (\Exception $e) {
            session()->setFlashdata('sessionUpload', "An error occurred: " . $e->getMessage());
            return redirect()->to('/dasbor/file/update/' . $data['id']);
        }
    }
    public function updateDrive()
    {
        $data = $this->request->getVar();
        try {
            $client = new Client();
            $client->setAuthConfig(WRITEPATH . '/secrets/drivenutrifeed-dcc00319371b.json');
            $client->addScope(Drive::DRIVE);
            $driveService = new Drive($client);
            $file = new Drive\DriveFile();
            $file->setName($data['folder']);
            $driveService->files->update($data['id'], $file);
            session()->setFlashdata('successUpload', 'File Berhasil di Ubah');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->setFlashdata('sessionUpload', "An error occurred: " . $e->getMessage());
            return redirect()->back();
        }
    }
    public function getFile()
    {
        $folder = $this->request->getVar('folder');
        $file = $this->request->getVar('file');
        if (session()->get('role') == 3) {
            $file = $this->appModel->getFileExcept();
        } else {
            $file = $this->appModel->findAll();
        }
        if ($folder) {

            try {
                $client = new Client();
                $client->setAuthConfig(WRITEPATH . '/secrets/drivenutrifeed-dcc00319371b.json');
                $client->addScope(Drive::DRIVE);
                $driveService = new Drive($client);
                $files = array();
                $pageToken = null;
                do {
                    if ($folder) {
                        $response = $driveService->files->listFiles(array(
                            'q' => "parents='$folder'",
                            'spaces' => 'drive',
                            'supportsAllDrives' => true,
                            'fields' => '*'

                        ));
                    } else {
                        $response = $driveService->files->listFiles(array(

                            'spaces' => 'drive',
                            'supportsAllDrives' => true,
                            'fields' => '*'

                        ));
                    }

                    $getWD = $driveService->files->get($folder);

                    $data = [
                        'title' => "File Manager",
                        'breadcrumb' => $this->breadcrumb->buildAuto(),
                        'file' => $response->files,
                        'folder' => $getWD
                    ];
                    return view('openFile', $data);


                    $pageToken = $response->pageToken;
                } while ($pageToken != null);
            } catch (\Exception $e) {
                session()->setFlashdata('successUpload', "An error occurred: " . $e->getMessage());
                return redirect()->to('/dasbor/file');
            }
        } else {
            $data = [
                'breadcrumb' => $this->breadcrumb->buildAuto(),
                'title' => 'File Manager',
                'file' => $file
            ];
            return view('fileManager', $data);
        }
    }
    public function doAddLink()
    {
        $data = $this->request->getVar();
        $query = $this->appModel->where('category', $data['catLink'])->first();
        if ($query) {
            session()->setFlashdata('link_status', 'Kategori Link Sudah Ada, Silahkan Ubah Melalui Daftar Link');
            return redirect()->to('/dasbor/link/tambah');
        } else {
            $this->appModel->save([
                'link' => $data['link'],
                'category' => $data['catLink'],
                'click' => 0
            ]);
            session()->setFlashdata('success_link', 'Data Link Berhasil Ditambahkan');
            return redirect()->to('/dasbor/link');
        }
    }
    public function doUpdateLink()
    {
        $data = $this->request->getVar();
        $this->appModel->update($data['id'], [
            'link' => $data['link']
        ]);
        session()->setFlashdata('success_link', 'Data Berhasil Diubah');
        return redirect()->to('/dasbor/link');
    }
    public function authorize($id)
    {
        $url = uri_string();
        $urlArray = explode("/", $url);
        if ($urlArray[2] === "enable") {
            $this->authModel->update($id, [
                'status' => 1
            ]);
        } else {
            $this->authModel->update($id, [
                'status' => 0
            ]);
        }
        return redirect()->to('/dasbor/user');
    }
    public function upload()
    {
        $query = $this->appModel->findAll();

        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Upload File',
            'link' => $query
        ];
        return view('upload', $data);
    }
    public function doUpload()
    {
        $file = $this->request->getFiles('file');
        $folder = $this->request->getVar();

        try {
            $client = new Client();
            $client->setAuthConfig(WRITEPATH . '/secrets/drivenutrifeed-dcc00319371b.json');
            //$client->useApplicationDefaultCredentials();
            $client->addScope(Drive::DRIVE);
            $driveService = new Drive($client);
            foreach ($file as $files) {
                foreach ($files as $f) {
                    $fileName = $f->getName();
                    $mimeType = $f->getClientMimeType();

                    $fileMetadata = new Drive\DriveFile(
                        array(
                            'name' => $fileName,
                            'addParents' => $folder['id']
                        )
                    );
                    $fileContent = file_get_contents($f);
                    
                    $fileMetadata->setParents([$folder['id']]);
                    $file = $driveService->files->create($fileMetadata, array(
                        'data' => $fileContent,
                        'mimeType' => $mimeType,
                        'uploadType' => 'multipart',
                        'fields' => 'id'
                    ));
                }
            }
            session()->setFlashdata('successUpload', 'File Berhasil di Upload');
            return redirect()->to(previous_url());
        } catch (\Exception $e) {
            $err = json_decode($e->getMessage());
            session()->setFlashdata('sessionUpload', "An error occurred: " . $e);
            return redirect()->to(previous_url());
        }
    }
    public function deleteFile($id)
    {
        try {
            $client = new Client();
            $client->setAuthConfig(WRITEPATH . '/secrets/drivenutrifeed-dcc00319371b.json');
            //$client->useApplicationDefaultCredentials();
            $client->addScope(Drive::DRIVE);
            $driveService = new Drive($client);
            $driveService->files->delete($id);
            $this->fileModel->deleteFile($id);
            session()->setFlashdata('successUpload', 'File Berhasil Di Hapus');
            return redirect()->back();
        } catch (\Exception $e) {
            $err = json_decode($e->getMessage());
            session()->setFlashdata('successUpload', "An error occurred: " . $err->error->message);
            return redirect()->back();
        }
    }
}
