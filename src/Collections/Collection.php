<?php
namespace Calendar\Collections;

class Collection implements \Iterator{

    protected $elements = array();

    /**
     * Collection constructor.
     * @param array $elements
     */
    public function __construct($elements = array()){
        if(is_array($elements)){
            $this->elements = $elements;
        }
    }

    /**
     * @return mixed
     */
    public function rewind(){
        return reset($this->elements);
    }

    /**
     * @return mixed
     */
    public function first(){
        return $this->rewind();
    }

    /**
     * @return mixed
     */
    public function current(){
        return current($this->elements);
    }

    /**
     * @return mixed
     */
    public function key(){
        return key($this->elements);
    }

    /**
     * @return mixed
     */
    public function next(){
        return next($this->elements);
    }

    /**
     * @return mixed
     */
    public function last(){
        return end($this->elements);
    }

    /**
     * @param $element
     * @return int
     */
    public function add($element){
        return array_push($this->elements, $element);
    }

    /**
     * @param $element
     * @return int
     */
    public function addOrMerge($element){
        if($element instanceof Collection) {
            $element = $element->toArray();
        }

        if(is_array($element)){
            $this->elements = array_merge($this->elements, $element);
        }else{
            $this->add($element);
        }
    }

    /**
     * @return int
     */
    public function isEmpty(){
        return empty($this->elements);
    }

    /**
     * @return int
     */
    public function count(){
        return count($this->elements);
    }

    /**
     * Dump collection values
     * @return void
     */
    public function dump(){
        var_dump($this->elements);
    }

    /**
     * @return array
     */
    public function toArray(){
        return $this->elements;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid(){
        $key = $this->key();
        return isset($this->elements[$key]);
    }
}
