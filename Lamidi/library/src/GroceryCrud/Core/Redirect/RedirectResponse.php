<?php
namespace GroceryCrud\Core\Redirect;

class RedirectResponse implements RedirectResponseInterface {

    /**
     * @var string
     */
    protected $_url = '';

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->_url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }
}