let base = location.protocol+'//'+location.host;
let route = document.getElementsByName('routeName')[0].getAttribute('content');

document.addEventListener('DOMContentLoaded', function(){
  
    let btn_search = document.getElementById('btn_search');
    let form_search = document.getElementById("form_search");
    if(btn_search) {
      btn_search.addEventListener("click", function(e){
        e.preventDefault();
        if(form_search.style.display === "block") {
          form_search.style.display="none";
        }else {
          form_search.style.display="block";
        }
      });
    }

    if(route == "products_edit") {
      let btn_product_file_image = document.getElementById('btn_product_file_image');
      let product_file_image = document.getElementById('product_file_image');

      btn_product_file_image.addEventListener('click', (e) => {
        e.preventDefault();
        product_file_image.click();
      }, false);

      product_file_image.addEventListener('change', () => {
        document.getElementById('form_product_gallery').submit();
      });
    }

    let route_active = document.getElementsByClassName("lk-"+route)[0].classList.add("active");

    let btn_deleted = document.getElementsByClassName("btn-deleted");
    for(let i = 0; i < btn_deleted.length; i++) {
      btn_deleted[i].addEventListener("click", delete_object);
    }
  });


$(document).ready(function() {
  editor_init('editor');
});

function editor_init(field) {
  CKEDITOR.replace(field, {
    toolbar: [
      {name: 'clipboard', items:['Cut', 'Copy','Past', 'PastTecxt', '-', 'Undo', 'Redo']},
      {name: 'basicstyles', items:['Bold', 'Italic', 'BulltedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockquote']},
      {name: 'document', items:['CodeSnippet', 'EmojiPanel', 'Preview', 'Source']}
    ]
  });
}


function delete_object(e) {
  e.preventDefault();
  let object = this.getAttribute("data-object");
  let action = this.getAttribute("data-action");
  let path = this.getAttribute("data-path");
  let url = base + '/' + path + '/' + object + '/' + action;
  let title, text, icon, confirmButton;

  if(action == "delete") {
    title = '¿Estas seguro de eliminar este elemento?';
    text = "Al aceptar, el elemento sera enviado a la papelera de reciclaje o sera eliminado definitivamente";
    icon = "warning";
    confirmButton = "Si, eliminalo";

  }
  if (action == "restore") {
    title = '¿Estas seguro de restaurar este elemento?';
    text = "Al aceptar, el elemento sera restaurado";
    icon = "info";
    confirmButton = "Si, restauralo";
  }
 
  Swal.fire({
    title: title,
    text: text,
    icon: icon,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: confirmButton,
  }).then((result) => {
    if (result.value) {
      window.location.href = url;
    }
  });
}