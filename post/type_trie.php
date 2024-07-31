<?php
    
    $array = filter_validate_type_trie();
    $nom = $array['nom'];
    $table_de = $array['table_de'];
    
    $type_trie = new TypeTrie();
    if ($nom) {
        if ($type_trie->insert($nom, $table_de)) {
            redirect_with_message('Insertion fait avec success !', FLASH_SUCCESS, 'type_trie', "type_trie.php");
        }
    } else {
        redirect_with_message('Error, l insertion n a pas ete faite', FLASH_ERROR, 'type_trie', "type_trie.php");
    }
    
    

