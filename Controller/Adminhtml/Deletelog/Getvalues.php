<?php
namespace Task\DeleteLog\Controller\Adminhtml\Deletelog;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\FileSystem\DirectoryList;
use Magento\Framework\FileSystem\Driver\File;

class Getvalues extends \Magento\Backend\App\Action
{
    /**
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * @var File
     */
    protected $driverFile;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    public function __construct(
        DirectoryList $directoryList,
        File $driverFile,
        ResultFactory $resultFactory,
        Context $context
    ) {
        $this->directoryList = $directoryList;
        $this->driverFile = $driverFile;
        $this->resultFactory = $resultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $value = $this->getRequest()->getParam('log_name');
        $collection = [];
        $delete_files = [];
        $flag = false;
        try {
            $folder = '/log/';
            $path = $this->directoryList->getPath('var') . $folder;
            $collection = $this->driverFile->readDirectory($path);
            foreach ($collection as $key => $filename) {
                if (stripos($filename, $value, 20)) {
                    $delete_files[] = $filename;
                }
            }
            if (!empty($delete_files)) {
                foreach ($delete_files as $key => $file) {
                    if ($this->driverFile->isExists($file)) {
                        $this->driverFile->deleteFile($file);
                    }
                }
                $flag = true;
            }
            if ($flag == true) {
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $url = $this->_redirect->getRefererUrl();
                $resultRedirect->setUrl($url);
                $this->messageManager->addSuccessMessage(__('All files related to ' . '"' .$value. '"' . ' keyword are deleted successfully'));
                return $resultRedirect;
            } else {
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $url = $this->_redirect->getRefererUrl();
                $resultRedirect->setUrl($url);
                $this->messageManager->addWarningMessage(__('No files found'));
                return $resultRedirect;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
