<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\AppModel;
use App\Models\FileModel;
use App\Models\AgenModel;
use App\Controllers\Log;
use App\Models\FolderModel;
use App\Models\LogModel;
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
        $this->agenModel = new AgenModel();
        $this->logModel = new LogModel();
        $this->log = new Log();
        $this->logType = 'event';
        $this->folderModel = new FolderModel();
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
        $logMsg = 'User ' . session()->get('name') . ' Membuka Link Data ' . $data['cat'];
        $this->log->doLog($this->logType, $logMsg);
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
        $jumlahAgen = count($this->authModel->where('role', 4)->findAll());
        if (session()->get('role') == 1 or session()->get('role') == 2) {
            $folder = $this->folderModel->findAll();
        } else {
            $folder = $this->folderModel->where('folder !=', 'Data Perusahaan')->findAll();
        }
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Dasbor',
            'link' => $jumlahLink,
            'klik' => $jumlahKlik,
            'user' => $jumlahUser,
            'agen' => $jumlahAgen,
            'folder' => $folder
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
        $logMsg = 'User ' . session()->get('name') . ' Menghapus Data Link';
        $this->log->doLog($this->logType, $logMsg);
        session()->setFlashdata('success_link', 'Data Berhasil Dihapus');
        return redirect()->to('/dasbor/link');
    }
    public function deleteUser($id)
    {
        $this->authModel->delete($id);
        $logMsg = 'User ' . session()->get('name') . ' Menghapus Data User';
        $this->log->doLog($this->logType, $logMsg);
        session()->setFlashdata('success_user', 'Data Berhasil Dihapus');
        return redirect()->to('/dasbor/user');
    }
    public function deleteAgen()
    {
        $data = $this->request->getVar();
        $this->authModel->delete($data['uid']);
        $this->agenModel->delete($data['id']);
        $logMsg = 'User ' . session()->get('name') . ' Menghapus Data Agen';
        $this->log->doLog($this->logType, $logMsg);
        session()->setFlashdata('success_user', 'Data Berhasil Dihapus');
        return redirect()->back();
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
            $folder = "name != 'Data Perusahaan'";
        } else {
            $folder = "mimeType = 'application/vnd.google-apps.folder'";
        }
        $qFolder = $this->request->getVar('folder');
        if ($qFolder) {
            $qDrive = "parents='$qFolder'";
        } else {
            $qDrive = $folder . "and parents='1CXYDZC65wUSlrE5wGr87tOu4vm6-2Kwi'";
        }
        try {
            $client = new Client();
            $client->setAuthConfig(WRITEPATH . '/secrets/drivenutrifeed-dcc00319371b.json');
            $client->addScope(Drive::DRIVE);
            $driveService = new Drive($client);
            $files = array();
            $pageToken = null;
            do {
                $response = $driveService->files->listFiles(array(
                    'q' => $qDrive,
                    'spaces' => 'drive',
                    'supportsAllDrives' => true,
                    'fields' => '*'
                ));
                $data = [
                    'title' => "File Manager",
                    'breadcrumb' => $this->breadcrumb->buildAuto(),
                    'file' => $response->files,
                    'folder' => $qFolder
                ];
                return view('fileManager', $data);
                $pageToken = $response->pageToken;
            } while ($pageToken != null);
        } catch (\Exception $e) {
            session()->setFlashdata('successUpload', "An error occurred: " . $e->getMessage());
            return view('fileManager');
        }
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
    public function addAgen()
    {
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Tambah Agen'
        ];
        return view('tambahAgen', $data);
    }
    public function doAddAgen()
    {
        $data = $this->request->getVar();
        $salt = uniqid('', true);
        $password = md5($data['pass']) . $salt;
        $this->agenModel->insertData($data['email'], $data['name'], $salt, $data['nameOwner'], $data['alamat'], $password, $data['referal']);
        $logMsg = 'User ' . session()->get('name') . ' Menambah Data Agen';
        $this->log->doLog($this->logType, $logMsg);
        session()->setFlashdata('success_user', 'Data Berhasil Ditambahkan');
        return redirect()->to('/dasbor/agen');
    }
    public function updateAgen($id)
    {
        $query = $this->agenModel->getQuery($id);
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Ubah Data Agen',
            'data' => $query
        ];
        return view('updateAgen', $data);
    }
    public function doUpdateAgen()
    {
        $data = $this->request->getVar();
        $salt = uniqid('', true);
        $password = md5($data['pass']) . $salt;
        $this->authModel->update($data['uid'], [
            'pass' => $password,
            'salt' => $salt
        ]);
        $logMsg = 'User ' . session()->get('name') . ' Mengubah Data Agen';
        $this->log->doLog($this->logType, $logMsg);
        session()->setFlashdata('success_user', 'User Berhasil Diubah');
        return redirect()->to('/dasbor/agen');
    }
    public function listAgen()
    {
        $user = session()->get('name');
        if (session()->get('role') == 5) {
            $getData = $this->agenModel->getData($user);
        } else {
            $getData = $this->agenModel->getData();
        }

        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Daftar Agen',
            'users' => $getData
        ];
        return view('listAgen', $data);
    }
    public function faq()
    {
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'FAQ'
        ];
        return view('faq', $data);
    }
    public function ubahPass()
    {
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Ganti Password',
        ];
        return view('ubahPassword', $data);
    }
    public function doChgPass()
    {
        $data = $this->request->getVar();
        $salt = uniqid('', true);
        $this->authModel->update($data['id'], [
            'salt' => $salt,
            'pass' => md5($data['pass']) . $salt
        ]);
        session()->setFlashdata('success_chg', 'Password Berhasil Diubah');
        return redirect()->to('/dasbor/user/ubah');
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
        $logMsg = 'User ' . session()->get('name') . ' Menambah Data User';
        $this->log->doLog($this->logType, $logMsg);
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
        $logMsg = 'User ' . session()->get('name') . ' Mengubah Data User';
        $this->log->doLog($this->logType, $logMsg);
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
                'fields' => '*'
            ));
            if ($data['desc']) {
                $this->folderModel->save([
                    'id_folder' => $file->id,
                    'link' => $file->webViewLink,
                    'folder' => $file->name,
                    'desc' => $data['desc']
                ]);
            }
            $logMsg = 'User ' . session()->get('name') . ' Membuat Folder';
            $this->log->doLog($this->logType, $logMsg);
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
            $logMsg = 'User ' . session()->get('name') . ' Mengubah File/Folder';
            $this->log->doLog($this->logType, $logMsg);
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
            if ($data['desc']) {
                $list = $driveService->files->get($data['id'], [
                    'fields' => '*'
                ]);
                if ($this->folderModel->where('id_folder', $data['id'])->first()) {
                    $this->folderModel->updateFolder($data['id'], $list->name, $data['desc']);
                } else {
                    $this->folderModel->save([
                        'id_folder' => $list->id,
                        'link' => $list->webViewLink,
                        'folder' => $list->name,
                        'desc' => $data['desc']
                    ]);
                }
            }
            $logMsg = 'User ' . session()->get('name') . ' Mengubah File/Folder';
            $this->log->doLog($this->logType, $logMsg);
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
            $logMsg = 'User ' . session()->get('name') . ' Menambah Link';
            $this->log->doLog($this->logType, $logMsg);
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
        $logMsg = 'User ' . session()->get('name') . ' Mengubah Link';
        $this->log->doLog($this->logType, $logMsg);
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
            $logMsg = 'User ' . session()->get('name') . ' Mengubah Status User';
            $this->log->doLog($this->logType, $logMsg);
        } else {
            $this->authModel->update($id, [
                'status' => 0
            ]);
            $logMsg = 'User ' . session()->get('name') . ' Mengubah Status User';
            $this->log->doLog($this->logType, $logMsg);
        }
        return redirect()->back();
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
            $logMsg = 'User ' . session()->get('name') . ' Upload File';
            $this->log->doLog($this->logType, $logMsg);
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
            $this->folderModel->where('id_folder', $id)->delete();
            $logMsg = 'User ' . session()->get('name') . ' Menghapus File';
            $this->log->doLog($this->logType, $logMsg);
            session()->setFlashdata('successUpload', 'File Berhasil Di Hapus');
            return redirect()->back();
        } catch (\Exception $e) {
            $err = json_decode($e->getMessage());
            session()->setFlashdata('successUpload', "An error occurred: " . $err->error->message);
            return redirect()->back();
        }
    }
    public function log()
    {
        $data = [
            'breadcrumb' => $this->breadcrumb->buildAuto(),
            'title' => 'Log Aktivitas',
            'auth' => $this->logModel->where('category', 'otorisasi')->findAll(),
            'event' => $this->logModel->where('category', 'event')->findAll()
        ];
        return view('log', $data);
    }
}
