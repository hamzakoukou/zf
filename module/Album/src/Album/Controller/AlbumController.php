<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Controller\AlbumTable;

class AlbumController extends AbstractActionController
{
    protected $albumTable;
  
    public function indexAction()
    {
        return new ViewModel(array(
            'rows' => $this->getAlbumTable()->fetchAll(),
        ));

        // return new ViewModel();
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
    public function getAlbumTable()
     {
         if (!$this->albumTable) {
             $sm = $this->getServiceLocator();
             $this->albumTable = $sm->get('Album\Model\AlbumTable');
             //$this->albumTable = $this->getServiceLocator()->get('adapter');
         }
         return $this->albumTable;
     }
}