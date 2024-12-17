<?php
namespace App\Html;
 
use App\Html\AbstractPage;  
 
class PageCounties extends AbstractPage
{
    static function table(array $entities){
        echo '<h1>Megyék</h1>';
        self::searchBar();
        echo'<table id="counties-table">';
        self::tableHead();
        self::tableBody($entities);
        echo "</table>";
    }
 
    static function tableHead()
    {
        echo '
        <thead>
            <tr>
                <th class="id-col">id</th>
                <th>Megnevezés</th>
                <th style="float: right; display: flex">
                    Művelet&nbsp;';                     
        echo'
                </th>
            </tr>
        <tr>
            <form method="post" action="">
                <td></td>
                <td><input type="text" name="new_name" placeholder="Új név" required></td>
                <td>
                    <button type="submit" name="btn-save-new-county" title="Mentés">
                        <i class="fa fa-save"></i> Mentés
                    </button>
                </td>
            </form>
        </tr>
            <tr id="editor" class="hidden">';
            echo '
            </tr>
        </thead>';
    }
    static function editor()
    {
        echo '
            <th>&nbsp;</th>
            <th>
                <form name="county-editor" method="post" action="">
                    <input type="hidden" id="id" name="id">
                    <input type="search" id="name" name="name" placeholder="Megye" required>
                    <button type="submit" id="btn-update-county" name="btn-update-county" title="Ment">Frissítés</button>
                    <button type="button" id="btn-cancel-county" title="Mégse">Mégse</button>
                </form>
            </th>
            <th class="flex">
            &nbsp;
            </th>
        ';
    }
    static function tableBody(array $entities)
    {   
        echo '<tbody>';
        foreach ($entities as $entity) {
            echo "
            <tr>
                <td>{$entity['id']}</td>
                <td id='name-{$entity['id']}'>{$entity['name']}</td> 
                <td class='flex'>
                    <form method='post' action='' class='inline-form'>
                        <input type='hidden' name='id' value='{$entity['id']}'>
                        <button type='submit' name='btn-edit-county' value='{$entity['id']}' title='Szerkesztés'>
                            <i class='fa fa-edit'></i>
                        </button>
                    </form>
                    <form method='post' action=''>
                        <button type='submit' id='btn-del-county-{$entity['id']}' name='btn-del-county' value='{$entity['id']}' title='Töröl'>
                            <i class='fa fa-trash'></i>
                        </button>
                    </form>
                </td>
            </tr>";
        }
        echo '</tbody>';
    }   
    public static function displayEditForm($countyResponse)
    {
        if (isset($countyResponse['data'])) {
            $county = $countyResponse['data'];
            $id = $county['id'];
            $name = $county['name'];
    
            echo "
            <form method='post' action=''>
                <input type='hidden' name='id' value='{$id}'>
                <label for='edit_name'>Új név:</label>
                <input type='text' name='edit_name' value='{$name}' required>
                <button type='submit' name='btn-save-edit-county'>Mentés</button>
                <button type='submit' name='btn-home'>Kilépés</button>
            </form>
            ";
        } else {
            echo "<p>Hiba történt a megye adatok lekérésekor.</p>";
        }
    }
}