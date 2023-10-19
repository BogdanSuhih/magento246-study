<?php

namespace Perspective\UiExample\Ui\Component\MassAction\Status;

use Magento\Framework\UrlInterface;

class Options extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $options;
    protected $data;
    protected $urlBuilder;
    protected $urlPath;
    protected $paramName;
    protected $additionalData = [];

    public function __construct(
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        $this->data = $data;
        $this->urlBuilder = $urlBuilder;
    }

    public function jsonSerialize()
    {
        if ($this->options === null) {
            $options = [
                [
                    "value" => "1",
                    "label" => ('Active'),
                ],
                [
                    "value" => "0",
                    "label" => ('Inactive'),
                ],
            ];

            $this->prepareData();

            foreach ($options as $optionCode) {
                $this->options[$optionCode['value']] = [
                    'type' => 'status_' . $optionCode['value'],
                    'label' => $optionCode['label'],
                ];

                if ($this->urlPath && $this->paramName) {
                    $this->options[$optionCode['value']]['url'] = $this->urlBuilder->getUrl(
                        $this->urlPath,
                        [
                            $this->paramName => $optionCode['value'],
                        ]
                    );
                }

                $this->options[$optionCode['value']] = array_merge_recursive(
                    $this->options[$optionCode['value']],
                    $this->additionalData
                );
            }

            $this->options = array_values($this->options);
        }
        return $this->options;
    }
}

