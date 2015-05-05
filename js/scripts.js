$(document).ready(function() {
    $('#product-form').on('submit', function (e) {

        e.preventDefault();

        $.ajax({
            type: 'post',
            url: 'calculate_prices.php',
            data: $(this).serialize(),
            success: function (response) {
                $priceContainer = $('#js-price-container');
                $priceContainer.html(response);
                $priceContainer.toggle();
                $('#add-to-offer-btn').removeClass('hidden');
            }
        });
    });
    
    $('#add-to-offer-btn').click(function () {
        var productList = $('#product-list');
        var productData = $('#product-form').serialize();
        
        $('#product-list').append(
            '<div class=\"col-xs-12 col-md-2 product transp-container\">'
            + '<h4>' + $("input[name='type']:checked").next().html() + '</h4>' 
            + '<p>' + $(".price").html() + '</p>'
            +'<div class=\"hidden product-details\" >'
            + productData 
            +'</div></div>'
        );
        
        $('#product-list').closest('.row.hidden').removeClass('hidden');
    });
    
    function toggleHouseWindowFields(){
        var singleSelected = $(this).val() === 'yhekordne';
        $('#js-window-opening-single').toggle(singleSelected);
        $('#js-window-opening-double').toggle(!singleSelected);
        $('#js-window-glass-single').toggle(singleSelected);
        $('#js-window-glass-double').toggle(!singleSelected);
    }
    
    function toggleDoorDivisionLbl(){
        var $doorDivisionLbl = $("#door-division-lbl");
        if($(this).val() === 'klaasuks'){
            $doorDivisionLbl.html("Klaaside jaotus")
        }
        else{
            $doorDivisionLbl.html("Tahvlite jaotus")
        }
    }
    
    function bindProductSpec(){
        $.ajax({
            type: 'post',
            url: 'product_spec_fields.php',
            data: $('form').serialize(),
            cache: false
        }).done(function( html ) {
            $('#js-product-spec').html(html);
            $('#js-product-spec').toggle(true);
            $('input[name="window-frame"]').bind('change', toggleHouseWindowFields);
            $('input[name="door-variant"]').bind('change', toggleDoorDivisionLbl);
            $('#product-form-btns').removeClass('hidden');
        }).fail(function( msg ) {
            alert(msg);
        });
    }
    
    function bindProductTypes(){
        chosenProduct = $(this).val();
        var typesSelector = '';

        switch(chosenProduct) {
            case 'aken':
                typesSelector = '#js-window-types-rbtns';
                break;
            case 'uks':
                typesSelector = '#js-door-types-rbtns';
                break;
            case 'trepp':
                typesSelector = '#js-stairs-types-rbtns';
                break;
        }
        
        $('#js-product-spec').toggle(false);

        var $typesRadios = $('#js-product-types');
        $typesRadios.html($(typesSelector).html());
        $typesRadios.toggle(true);
        $('input[name="type"]').bind('change', bindProductSpec);
    }

    $('input[name="product"]').bind('change', bindProductTypes);
});



