<?php
declare(strict_types = 1);
namespace Post\Entity;

class Post
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $text;

    /**
     *
     * @var string
     */
    private $title;

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        if (null !== $data) {
            $this->exchangeArray($data);
        }
    }

    /**
     * Exchange internal values from provided array
     *
     * @param  array $array
     * @return void
     */
    public function exchangeArray(array $data)
    {
        $this->id = ! empty($data['id']) ? $data['id'] : null;
        $this->title = ! empty($data['title']) ? $data['title'] : null;
        $this->text = ! empty($data['text']) ? $data['text'] : null;
    }

    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'text' => $this->text
        ];
    }
    /**
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * 
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    /**
     * 
     * @param string $text
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * 
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
}

