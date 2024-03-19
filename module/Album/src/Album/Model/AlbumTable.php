<?php
 namespace Album\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Adapter\Adapter;

 class AlbumTable 
 {
    private $_db;
    public $adapter;
    
    // public function __construct($db) {
    //     $this->_db = $db;
    //     $this->adapter = new Adapter([
    //         'driver' => 'Pdo_Mysql',
    //         'database' => 'data',
    //         'username' => 'root',
    //         'password' => '',
    //     ]);
    // }

    // public function getAllRows() {
    //     $sql = 'SELECT * FROM album';
    //     $stat = $this->_db->query($sql);        
    //     return $stat->fetchAll();
    // }


     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getAlbum($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveAlbum(Album $album)
     {
         $data = array(
             'artist' => $album->artist,
             'title'  => $album->title,
         );

         $id = (int) $album->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getAlbum($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Album id does not exist');
             }
         }
     }

     public function deleteAlbum($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }