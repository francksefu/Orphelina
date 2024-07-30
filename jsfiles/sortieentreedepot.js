$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    $('#myInput').on('focus', function() {
        $('#all-table-product').show();
        
        $('.line_to_take').on('click', function() {
            var unite = $(this).children('.unite_de_mesure').text();
            var content = $(this).children('.nom').text();
            var contenu_produit = {id: $(this).children('.id').text(), nom: $(this).children('.nom').text(), quantite: $(this).children('.quantiteStock').text(), unite_mesure: $(this).children('.unite_de_mesure').text()};
            $('#contenu_produit').val(JSON.stringify(contenu_produit));
            $('#unite_de_mesure').text(unite);
            $('#myInput').val(content);
            $('#all-table-product').hide();
        })
    });
    $('#button').on('click', function() {
        if ($('#contenu_produit').val() !== '' && $('#quantite').val() !== '') {
            let tab = JSON.parse($('#contenu_produit').val());
            let line = "<tr class='line_show'><td>"+tab['id']+"</td><td>"+tab['nom']+"</td><td>" + $('#quantite').val() + ' ' +tab['unite_mesure']+ "</td><td> <a href='#' class='btn btn-danger supprime'> Supprimer </a> </td></tr>";
            $('#tbody').append(line);
            let array_product_quantity_to_insert = {id: tab['id'], quantite: $('#quantite').val()}
            let arr = [];
            if($('#array_of_product_and_quantity').val() === '') {
                arr = [];
            } else {
                arr = JSON.parse($('#array_of_product_and_quantity').val());
            }
            arr.push(array_product_quantity_to_insert);
            $('#array_of_product_and_quantity').val(JSON.stringify(arr));
            
            $('#myInput').val('');
            $('#contenu_produit').val('');
            $('#quantite').val('');
            $('#unite_de_mesure').text('');
        }
    });

    $('#quantite').on('blur', function() {
        let text = $('#quantite').val();
        function isValidNumber(input) {
            var pattern = /^[0-9.]+$/;
            return pattern.test(input);
        }
        
        if(! isValidNumber(text)) {
            $(this).addClass('border border-danger');
            $('#button').hide();
            $('#info-quantity').text('Dans le champs de quantite vous ne pouvez mettre que les chiffres, corrigez, ensuite cliquez a l exterieur du champ et le button reapparaitra');
        } else {
            $(this).removeClass('border border-danger');
            $('#button').show();
            $('#info-quantity').text('');
        }
    });
    $('#generale-table').on('mouseover', function() {
        const arrnew = JSON.parse($('#array_of_product_and_quantity').val());
        $('.supprime').each(function(index) {
            $(this).on('click',function() {
                arrnew.splice(index, 1);
                $(this).parents('tr').remove();
                $('#array_of_product_and_quantity').val(JSON.stringify(arrnew));
            });
        });
    });

  });

  $(document).ready(function() {
    var age = 'i';
    $('#age_number').on('change', function() {
         age = $('#age_precis').val() +' '+ $(this).val() +' '+ $('#age_time').val();
        $('#age').val(age);
    });

    $('#age_time').on('change', function() {
         age = $('#age_precis').val() +' '+ $('#age_number').val() +' '+ $(this).val();
        $('#age').val(age);
    });

    $('#age_precis').on('change', function() {
         age = $(this).val() +' '+ $('#age_number').val() +' '+ $('#age_time').val();
        $('#age').val(age);
    });
  })
  


