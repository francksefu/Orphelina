<?php
function add_rapport($urlpost, $array_of_type_trie)
{
    $type_trie = '';
    foreach($array_of_type_trie as $typetrie) {
        $type_trie .= "<option value='".$typetrie['idTypeTrie']."' >".$typetrie['name']."  -> ".$typetrie['table_de']."</option>";
    }
    $content = "<h2 class='text-secondary m-2 text-center'>".tr('Rapports')."</h2>
    
        <div class='row mb-3'>
            
            <div class='col-md-3 border p-3'>
            <h5 class='text-secondary text-center'>1 date</h5>
                <div class='m-2'>
                    <button type='button' class='btn btn-dark'>".tr('Comptabilite')."</button>
                    <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' aria-expanded='false'>
                        <span class='visually-hidden'>Toggle Dropdown</span>
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <li><a class='dropdown-item' id='entree_comptabilite' href='#'>".tr('Entrée')."</a></li>
                        <li><a class='dropdown-item' id='sortie_comptabilite' href='#'>".tr('Sortie')."</a></li>
                        <li><hr class='dropdown-divider'></li>
                        <li><a class='dropdown-item' id='entree_comptabilite_trie' href='#'>".tr('Entrée trié')." </a></li>
                        <li><a class='dropdown-item' id='sortie_comptabilite_trie' href='#'>".tr('Sortie trié')."</a></li>
                    </ul>
                </div>
                <div class='m-2'>
                    <button type='button' class='btn btn-dark'>Depots</button>
                    <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' aria-expanded='false'>
                        <span class='visually-hidden'>Toggle Dropdown</span>
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <li><a class='dropdown-item' id='entree_depot' href='#'>".tr('entrée dans le depot')."</a></li>
                        <li><a class='dropdown-item' id='sortie_depot' href='#'>".tr('sortie dans le depot')."</a></li>
                    </ul>
                </div>
                <div class='m-2'>
                    <button type='button' class='btn btn-dark'>".tr('Inventaire')."</button>
                    <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' aria-expanded='false'>
                        <span class='visually-hidden'>Toggle Dropdown</span>
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <li><a class='dropdown-item' id='entree_inventaire' href='#'>".tr('inventaire des entrées')."</a></li>
                        <li><a class='dropdown-item' id='sortie_inventaire' href='#'>".tr('inventaire des sorties')."</a></li>
                    </ul>
                </div>
            </div>
            <div class='col-md-6'>
            <form method='post' action='$urlpost' class='container-fluid'>
                <div class='input-group mb-3'>
                    <span class='input-group-text date1' id='basic-addon1'>Date 1 </span>
                    <input type='date' name='date1' class='form-control date1' placeholder='Ecrivez la date ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3' id='date2'>
                    <span class='input-group-text date2' id='basic-addon1'>Nom </span>
                    <input type='date' name='date2' class='form-control date2'  placeholder='Ecrivez la date ici' aria-label='Username' aria-describedby='basic-addon1'>
                </div>
                <div class='input-group mb-3' id='type_trie'>
                    <label class='input-group-text type_trie' for='inputGroupSelect01'>Types de trie comptabilité :</label>
                    <select class='form-select type_trie' name='type_trie' id='inputGroupSelect01'>
                        $type_trie
                    </select>
                </div>
                <input type='hidden' name='request' id='request'>
                <input type='hidden' name='extra_information'>
                <input type='submit' class='btn btn-primary date1' value='Soumettre'>
            </form>
            </div>

            <div class='col-md-3 border p-3'>
                <h5 class='text-secondary text-center'>2 date</h5>
                <div class='m-2'>
                    <button type='button' class='btn btn-dark'>".tr('Comptabilite')."</button>
                    <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' aria-expanded='false'>
                        <span class='visually-hidden'>Toggle Dropdown</span>
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <li><a class='dropdown-item' id='entree_comptabilite2' href='#'>".tr('Entrée')."</a></li>
                        <li><a class='dropdown-item' id='sortie_comptabilite2' href='#'>".tr('Sortie')."</a></li>
                        <li><hr class='dropdown-divider'></li>
                        <li><a class='dropdown-item' id='entree_comptabilite_trie2' href='#'>".tr('Entrée trié')."</a></li>
                        <li><a class='dropdown-item' id='sortie_comptabilite_trie2' href='#'>".tr('Sortie trié')."</a></li>
                    </ul>
                </div>
                <div class='m-2'>
                    <button type='button' class='btn btn-dark'>Depots</button>
                    <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' aria-expanded='false'>
                        <span class='visually-hidden'>Toggle Dropdown</span>
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <li><a class='dropdown-item' id='entree_depot2' href='#'>".tr('entrée dans le depot')."</a></li>
                        <li><a class='dropdown-item' id='sortie_depot2' href='#'>".tr('sortie dans le depot')."</a></li>
                    </ul>
                </div>
                <div class='m-2'>
                    <button type='button' class='btn btn-dark'>".tr('Inventaire')."</button>
                    <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' aria-expanded='false'>
                        <span class='visually-hidden'>Toggle Dropdown</span>
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <li><a class='dropdown-item' id='entree_inventaire2' href='#'>".tr('inventaire des entrées')."</a></li>
                        <li><a class='dropdown-item' id='sortie_inventaire2' href='#'>".tr('inventaire des sorties')."</a></li>
                    </ul>
                </div>
                <div class='m-2'>
                    <button type='button' class='btn btn-dark'>".tr('Enfant')."</button>
                    <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' aria-expanded='false'>
                        <span class='visually-hidden'>Toggle Dropdown</span>
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <li><a class='dropdown-item' id='enfant2' href='#'>".tr('enfant reunifie entre 2 date')."</a></li>
                    </ul>
                </div>
            </div>
            
        
    ";
    return $content;
}