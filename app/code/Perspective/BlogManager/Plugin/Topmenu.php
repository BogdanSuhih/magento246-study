<?php
namespace Perspective\BlogManager\Plugin;

class Topmenu
{
    protected $_nodeFactory;
    protected $_urlBuilder;

    public function __construct(
        \Magento\Framework\Data\Tree\NodeFactory $nodeFactory,
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->_nodeFactory = $nodeFactory;
        $this->_urlBuilder = $urlBuilder;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $topmenu,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        /**
         * Parent Menu
         */
        $menuNode = $this->_nodeFactory->create(
            [
                'data' => $this->getNodeAsArray("Blog", "blog"),
                'idField' => 'id',
                'tree' => $topmenu->getMenu()->getTree(),
            ]
        );
        
        /**
         * Add Child Menu
         */
        // $menuNode->addChild(
        //     $this->_nodeFactory->create(
        //         [
        //             'data' => $this->getNodeAsArray("Sub Menu", "sub-menu"),
        //             'idField' => 'id',
        //             'tree' => $topmenu->getMenu()->getTree(),
        //         ]
        //     )
        // );
        
        $topmenu->getMenu()->addChild($menuNode);
    }

    protected function getNodeAsArray($name, $id) {
        $url = $this->_urlBuilder->getUrl($id);
        return [
            'name' => __($name),
            'id' => $id,
            'url' => $url,
            'has_active' => false,
            'is_active' => false,
        ];
    }
}