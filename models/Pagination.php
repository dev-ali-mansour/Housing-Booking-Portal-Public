<?php
/**
 * Created by PhpStorm.
 * User: Ali Mansour
 * Date: 10/23/2017
 * Time: 8:31 PM
 */

class Pagination
{
    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($page = 1, $total_count = 0)
    {
        $this->current_page = (int)$page;
        $this->per_page = (int)MAX_RECORDS;
        $this->total_count = (int)$total_count;
    }

    public function offset()
    {
        return ($this->current_page - 1) * $this->per_page;
    }

    public function hasPreviousPage()
    {
        return $this->previousPage() >= 1 ? true : false;
    }

    public function previousPage()
    {
        return $this->current_page - 1;
    }

    public function hasNextPage()
    {
        return $this->nextPage() <= $this->totalPages() ? true : false;
    }

    public function nextPage()
    {
        return $this->current_page + 1;
    }

    public function totalPages()
    {
        return ceil($this->total_count / $this->per_page);
    }

    public function paginate($target){
        if ($this->totalPages() > 1) {
            echo '<div class="centered"><ul class="pagination centered">';
            if ($this->current_page == 1) {
                echo "<li class='disabled'><a href='#'></span><span class='glyphicon glyphicon-forward'></span></a></li>";
            } else {
                echo "<li><a href=/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/$target/list/1></span><span class='glyphicon glyphicon-forward'></span></a></li>";
            }
            if ($this->hasPreviousPage()) {
                echo "<li><a href=/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/$target/list/{$this->previousPage()}><span class='glyphicon glyphicon-chevron-right'></span></a></li>";
            } else {
                echo "<li class='disabled'><a href='#'><span class='glyphicon glyphicon-chevron-right'></span></a></li>";
            }
            for ($i = 1; $i <= $this->totalPages(); $i++) {
                if ($this->current_page == $i) {
                    echo "<li class='active'><a>$i</a></li>";
                } else {
                    if ($this->current_page > $i && ($this->current_page - $i) <= 5) {
                        echo "<li><a href=/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/$target/list/{$i}>{$i}</a></li>";
                    } elseif ($this->current_page < $i && ($i - $this->current_page) <= 5 && ($i - $this->current_page) > 0) {
                        echo "<li><a href=/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/$target/list/{$i}>{$i}</a></li>";
                    }
                }
            }
            if ($this->hasNextPage()) {
                echo "<li><a href=/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/$target/list/{$this->nextPage()}><span class='glyphicon glyphicon-chevron-left'></span></a></li>";
            } else {
                echo "<li class='disabled'><a><span class='glyphicon glyphicon-chevron-left'></span></a></li>";
            }
            if ($this->current_page == $this->totalPages()) {
                echo "<li class='disabled'><a></span><span class='glyphicon glyphicon-backward'></span></a></li>";
            } else {
                echo "<li><a href=/" . BASE_DIRECTORY . "/" . ADMIN_DIRECTORY . "/$target/list/{$this->totalPages()}></span><span class='glyphicon glyphicon-backward'></span></a></li>";
            }
            echo '</ul></div>';
        }
    }
}