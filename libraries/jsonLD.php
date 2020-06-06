<?php
/*
Trần Quốc Lộc - 112
tranquoclocnina@gmail.com
*/
class jsonLD
{

    public $_title;
    public $_type;
    public $_description;
    public $_url;
    public $_images;
    public $_values = array();

    public function __construct(array $defaults)
    {
        $this->setUrl($defaults['url']);
        unset($defaults['url']);

        $this->setTitle($defaults['title']);
        unset($defaults['title']);

        $this->setImages($defaults['image']);
        unset($defaults['image']);

        $this->setType($defaults['type']);
        unset($defaults['type']);

        $this->setDescription($defaults['description']);
        unset($defaults['description']);
        $this->_values = $defaults;
    }

    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    public function setDescription($description)
    {
        $this->_description = strip_tags($description);
        return $this;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

    public function setImages($images)
    {
        $this->_images = array();

        return $this->addImage($images);
    }
    public function addImage($image)
    {
        if (is_array($image)) {
            $this->_images = array_merge($this->_images, $image);
        } elseif (is_string($image)) {
            $this->_images[] = $image;
        }

        return $this;
    }
    public function setImage($image)
    {
        $this->_images = array($image);

        return $this;
    }

    public function addValue($key, $value)
    {
        $this->_values[$key] = $value;

        return $this;
    }

    public function addValues(array $values)
    {
        foreach ($values as $key => $value) {
            $this->addValue($key, $value);
        }

        return $this;
    }

    public function generator()
    {
        $_array_schema = array(
            "@context" => "https://schema.org/",
        );

        if (!empty($this->_type)) {
            $_array_schema["@type"] = $this->_type;
        }

        if (!empty($this->_title)) {
            $_array_schema['name'] = $this->_title;
        }

        if (!empty($this->_description)) {
            $_array_schema["description"] = $this->_description;
        }
        if (!empty($this->_url)) {
            $_array_schema["url"] = $this->_url;
        }

        if (!empty($this->_images)) {
            $_array_schema['image'] = count($this->_images) === 1 ? reset($this->_images) : json_encode($this->_images, JSON_UNESCAPED_SLASHES);
        }

        $_array_schema = array_merge($_array_schema, $this->_values);

        $str = '<script type="application/ld+json">';
        $str .= json_encode($_array_schema);
        $str .= '</script>';
        return $str;
    }
}
