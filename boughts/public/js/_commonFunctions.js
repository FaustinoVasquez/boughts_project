function myAjaxGET(url, method,data='') {
    let result = '';
    $.ajax({
        url: url,
        method: method,
        dataType: 'json',
        data: data,
        async: false,
        success: function (ret) {
            if(ret.success){
                if(ret.msg)
                $.notify({message: ret.msg},{type: 'success', z_index: 2000,});
              // $modal.modal('hide');
            }
            return result=ret;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if( jqXHR.status === 401 ) //redirect if not authenticated user.
                $( location ).prop( 'pathname', 'auth/login' );
            if( jqXHR.status === 422 ) {

                RemoveErrorsFields($form);

                let $errors = jqXHR.responseJSON.errors;
                $.each($errors, function( key, value ) {
                    let input = $form.find(`[name=${key}]`);
                    $(input).addClass('is-invalid');
                    $(input).parent().find('.invalid-feedback>strong').text(value);
                    $(input).next('span.invalid-feedback');
                });

                let myMessages='';
                $.each($errors, function( key, value ) {
                    myMessages += `<p><strong>${key}:</strong>${value}</p>`
                });

                $.notify({
                    title: `<p><strong>Please check your request, there are some errors on your submit:</strong></p>`,
                    message: myMessages
                },{
                    type: 'danger',z_index: 2000});
            }
            else {
                alert('Something went wrong. Please try again')
            }
        }
    });
    return result;
}

function myAjaxPost(url,method,data=''){
    let result = '';
    $.ajax({
        url: url,
        method: method,
        dataType: 'json',
        data: data,
        async: false,
        success: function (ret) {
            if(ret.success){
                $.notify({message: ret.msg},{type: 'success', z_index: 2000,});
                $modal.modal('hide');
            }
             return result=ret;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if( jqXHR.status === 401 ) //redirect if not authenticated user.
                $( location ).prop( 'pathname', 'auth/login' );
            if( jqXHR.status === 422 ) {

                RemoveErrorsFields($form);

                let $errors = jqXHR.responseJSON.errors;
                $.each($errors, function( key, value ) {
                    let input = $form.find(`[name=${key}]`);
                    $(input).addClass('is-invalid');
                    $(input).parent().find('.invalid-feedback>strong').text(value);
                    $(input).next('span.invalid-feedback');
                });

                let myMessages='';
                $.each($errors, function( key, value ) {
                    myMessages += `<p><strong>${key}:</strong>${value}</p>`
                });

                $.notify({
                    title: `<p><strong>Please check your request, there are some errors on your submit:</strong></p>`,
                    message: myMessages
                },{
                    type: 'danger',z_index: 2000});
            }
            else {
                alert('Something went wrong. Please try again')
            }
        }
    });
    return result;
}

function fillFields(row,$form){
    $form.each(function () {
        $(this).find(':input').val(function(index, value){
            return row[this.id]
        });
    });
}

function RemoveErrorsFields($form){
    $form.each(function () {
        let input = $(this).find(':input');
        input.hasClass('is-invalid') ? input.removeClass('is-invalid') :'';
    });
}

function getRowData(id,column=''){

    let location = window.location.origin + window.location.pathname;
    let url =location+`/${id}/edit`;

    if (column){
        url =location+`/${id}/edit/${column}`;
    }

    return myAjaxGET(url, 'GET');
}

function addzeros(number, length) {
    var num = '' + number;
    while (num.length < length) {
        num = '0' + num;
    }
    return num;
}

function readURL(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function format(d){
    let ht='';
    if (!d.length){
        ht += `<div><h4>No Images to show</h4><div>`
    }else {
        $.each(d, function (index, row) {
            ht += `
                    <div class="img-column">
                        <a href="${row.URL}" target="_blank">
                            <img src="${row.URL}" alt="Forest" style="width:100%" target="_blank">
                        </a>
                    </div>`
        });
    }
    return ht;
}

function getImages(sku){
    let images =myAjaxGET(`catalog/${sku}`, 'GET');
    let myRows='';
    let imageNum='';
    let arrayImages ='';

        for (let i = 0; i < 20; i++) {
            if(images[i].ImageExists){
                myRows +=`<div class="row" data-id="div-${addzeros(i + 1, 3)}">
                <div class="col-md-3">
                    <a href="${images[i].URL}" 
                        target="_blank" 
                        id="a-${addzeros(i + 1, 3)}">
                        <img src="${images[i].URL}" 
                        alt="#" 
                        width="100" 
                        height="100" 
                        id="image-${addzeros(i + 1, 3)}">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Image ${i+1}:</label>
                         <input type="file" 
                                class="store-image" 
                                data-item="${images[i].ID}"
                                data-name="${images[i].ID}-${addzeros(i + 1, 3)}"
                                data-num= ${addzeros(i + 1, 3)}
                                data-id="id" 
                                id="input-${addzeros(i + 1, 3)}">
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <button type="button" 
                       data-id="${images[i].ID}"
                       data-sku="${images[i].SKU}" 
                       data-num= ${addzeros(i + 1, 3)}
                       class="btn btn-danger btn-block delete-image" 
                       id="btn-${addzeros(i + 1, 3)}">Delete</button>
                </div>
            </div>`;
            }else{
                myRows +=`<div class="row">
                <div class="col-md-3">
                    <a href="http://remotespict.mitechnologiesinc.com/no_image.png" 
                       target="_blank" id="a-${addzeros(i + 1, 3)}">
                        <img src="http://remotespict.mitechnologiesinc.com/no_image.png" 
                        alt="#" 
                        style="width: 108px;height:66px " 
                        id="image-${addzeros(i + 1, 3)}">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Image ${i+1}:</label>
                         <input type="file"
                                class="store-image" 
                                data-item="${sku}"
                                data-name="${sku}-${addzeros(i + 1, 3)}"
                                data-num= ${addzeros(i + 1, 3)}
                                data-id="sku"
                                id="input-${addzeros(i + 1, 3)}">
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                   <button type="button" 
                     data-id="#"
                     data-sku="#" 
                     data-num= ${addzeros(i + 1, 3)}
                    class="btn btn-danger btn-block disabled delete-image" 
                    id="btn-${addzeros(i + 1, 3)}" >Delete</button>
                </div>
              </div>`;
            }
        }
    return myRows;
}

$(document).on('click','.navbar-btn',function(){
    $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
});

$(document).on('change','.custom-checkbox',function() {
    $(this).attr('value', this.checked);
});

let modalConfirm = function(callback){
    $modal =$("#confirm-modal");
    $modal.modal('show');

    $("#btn-ok").on("click", function(){
        callback(true);
        $("#confirm-modal").modal('hide');
    });

    $("#btn-no").on("click", function(){
        callback(false);
        $("#confirm-modal").modal('hide');
    });
};

function cleanData(d){
 return  `
        <ul class="nav nav-tabs" id="cleanTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="amazon-tab" data-toggle="tab" href="#amazon" role="tab" aria-controls="amazon" aria-selected="true">Amazon</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ebay-tab" data-toggle="tab" href="#ebay" role="tab" aria-controls="ebay" aria-selected="false">Ebay</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="bullets-tab" data-toggle="tab" href="#bullets" role="tab" aria-controls="bullets" aria-selected="false">Bullets</a>
          </li>
          
           <li class="nav-item">
            <a class="nav-link" id="cust-tab" data-toggle="tab" href="#cust" role="tab" aria-controls="cust" aria-selected="false">Custom Fields</a>
          </li>
        </ul>
        <div class="tab-content" id="cleanTabContent">
            <div class="tab-pane fade show active" id="amazon" role="tabpanel" aria-labelledby="amazon-tab">
          
                 <table cellpadding="2" cellspacing="0" style="padding-left:10px;">
                    <tr class="table-info"><td width="15%"><b>AmazonTitle</b></td><td>${d.AmazonTitle}</td></tr>
                    <tr><td><b>AmazonCategory</b></td><td>${d.AmazonCategory}</td></tr>
                    <tr class="table-info"><td><b>AmazonProductType</b></td><td>${d.AmazonProductType}</td></tr>
                    <tr><td><b>AmazonProductSubtype</b></td><td>${d.AmazonProductSubtype}</td></tr>
                    <tr class="table-info"><td><b>AmazonShipTemplate</b></td><td>${d.AmazonShipTemplate}</td></tr>
                </table>
          
            </div>
            <div class="tab-pane fade" id="ebay" role="tabpanel" aria-labelledby="ebay-tab">
                <table cellpadding="2" cellspacing="0" style="padding-left:10px;">
                    <tr class="table-info"><td width="15%"><b>eBayTitle</b></td><td>${d.eBayTitle}</td></tr>
                    <tr><td><b>eBaySubtitle</b></td><td>${d.eBaySubtitle}</td></tr>
                    <tr><td><b>MobileDescription</b></td><td>${d.MobileDescription}</td></tr>
                    <tr class="table-info"><td><b>FullDescription</b></td><td>${d.FullDescription}</td></tr>
                </table>
               
            </div>
            <div class="tab-pane fade" id="bullets" role="tabpanel" aria-labelledby="bullets-tab">
                <table cellpadding="2" cellspacing="0" style="padding-left:10px;">
                    <tr class="table-info"><td width="15%"><b>Bullet1</b></td><td>${d.Bullet1}</td></tr>
                    <tr><td><b>Bullet2</b></td><td>${d.Bullet2}</td></tr>
                    <tr class="table-info"><td><b>Bullet3</b></td><td>${d.Bullet3}</td></tr>
                    <tr><td><b>Bullet4</b></td><td>${d.Bullet4}</td></tr>
                    <tr class="table-info"><td><b>Bullet5</b></td><td>${d.Bullet5}</td></tr>
                    <tr><td><b>SearchKeywords</b></td><td>${d.SearchKeywords}</td></tr>
                </table>
            </div> 
            
            <div class="tab-pane fade" id="cust" role="tabpanel" aria-labelledby="bullets1-tab">
               <table cellpadding="2" cellspacing="0" style="padding-left:10px;">
                    <tr class="table-info"><td width="15%"><b>CustomField1</b></td><td>${d.CustomField1}</td></tr>
                    <tr><td><b>CustomField2</b></td><td>${d.CustomField2}</td></tr>
                    <tr class="table-info"><td><b>CustomField3</b></td><td>${d.CustomField3}</td></tr>
                    <tr><td><b>CustomField4</b></td><td>${d.CustomField4}</td></tr>
                    <tr class="table-info"><td><b>CustomField5</b></td><td>${d.CustomField5}</td></tr>
                </table>
            </div> 
            
        </div>
        `;
}
