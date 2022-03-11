// show product
function autocomplete(inp, product,append,tag,append2) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var arr = product.name;
  var arr2 = tag.name;
  var currentFocus;
  for(m=0;m < inp.length ; m++){
    /*execute a function when someone writes in the text field:*/
    inp[m].addEventListener("input", function(e) {
        var a, b, i,c,d, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { $('.suggestion-box').addClass('hidden'); return false;}
        $('.suggestion-box').removeClass('hidden');
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("UL");
        a.setAttribute("class", "list-group output-search");
        /*append the DIV element as a child of the autocomplete container:*/
        document.getElementsByClassName(append)[0].appendChild(a);
        /*create a DIV element that will contain the items (values):*/
        c = document.createElement("UL");
        c.setAttribute("class", "list-group output-tag");
        /*append the DIV element as a child of the autocomplete container:*/
        document.getElementsByClassName(append2)[0].appendChild(c);
        /*for each item in the array...*/
        var search = 0;
        var search2 = 0;
        for (i = 0; i < arr.length; i++) {
          for (j = 0; j < arr[i].length; j++) {
            var html = '';
            var html2 = '';
            var price_old = '';
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(j, val.length).toUpperCase() == val.toUpperCase()) {
              search = 1;
              /*create a DIV element for each matching element:*/
              b = document.createElement("LI");
              b.setAttribute("class", "item-suggest d-flex");
              /*add html in LI*/
              if(product.discount[i] > 0){
                price_old = `<span class="price-old">`+product.price_old[i]+` đ</span>`;
              }
              html += `<a href="`+product.link[i]+`">
                      <img src="/images/item/`+product.image[i]+`" alt="`+arr[i]+`">
                  </a>` 
              html += `<div class="item-info">
                        <a href="`+product.link[i]+`" class="item-info-title">
                            <p>`+arr[i]+`</p>
                        </a>
                        <p class="price">
                            <span class="price-new">`+product.price_new[i]+` đ</span>
                            `+price_old+`
                        </p>
                        <div class="item-gift">
                            <img src="../images/icon/presents_2.png">
                            <span>Phần mềm Quản lý bán hàng </span>
                        </div>
                    </div>`
              b.innerHTML = html;
              b.addEventListener("click", function(e) {
                  /*insert the value for the autocomplete text field:*/
                  inp.value = this.getElementsByTagName("input")[m].value;
                  /*close the list of autocompleted values,
                  (or any other open lists of autocompleted values:*/
                  closeAllLists();
              });
              a.appendChild(b);
              break;
            }
            /*check if the item starts with the same letters as the text field value:*/
            if (arr2[i].substr(j, val.length).toUpperCase() == val.toUpperCase()) {
              search2 = 1;
              /*create a DIV element for each matching element:*/
              d = document.createElement("LI");
              d.setAttribute("class", "list-group-item li-output-tag");
              html2 += `<a href="`+tag.link[i]+`">`+arr2[i]+`</a>`;
              d.innerHTML = html2;
              /*execute a function when someone clicks on the item value (DIV element):*/
              d.addEventListener("click", function(e) {
                  /*insert the value for the autocomplete text field:*/
                  inp.value = this.getElementsByTagName("input")[m].value;
                  /*close the list of autocompleted values,
                  (or any other open lists of autocompleted values:*/
                  closeAllLists();
              });
              c.appendChild(d);
              break;
            }
          }
        }
        if(search == 0 ){
          b = document.createElement("LABEL");
          b.setAttribute("class", "no-result");
          b.innerHTML = `Không có kết quả tìm kiếm phù hợp`;
          b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
        });
        a.appendChild(b);
        }
        if(search2 == 0 ){
          d = document.createElement("LI");
          d.setAttribute("class", "list-group-item txt-center");
          d.innerHTML = `Không có kết quả tìm kiếm phù hợp`;
          d.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
        });
        c.appendChild(d);
        }
    });
  }
  
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("list-group output-search");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
    var y = document.getElementsByClassName("list-group output-tag");
    for (var j = 0; j < y.length; j++) {
      if (elmnt != y[j] && elmnt != inp) {
        y[j].parentNode.removeChild(y[j]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
// show tag
function getProduct() {
  var listproduct = [];
  var object_name = [];
  var object_link = [];
  var object_image = [];
  var object_price_new = [];
  var object_price_old = [];
  var object_discount = [];
  $.ajax({
    url: './ajax/getProduct.php',
    type: 'POST',
    dataType: 'json',
    success: function(data){
      var list = data;
      var i=0;
      for(index in list){
        object_name[i] = list[index].name;
        object_link[i] = list[index].link;
        object_image[i] = list[index].image;
        object_price_new[i] = list[index].price_new;
        object_price_old[i] = list[index].price_old;
        object_discount[i] = list[index].discount;
        i++;
      }
    }
  });
  listproduct['name'] = object_name;
  listproduct['link'] = object_link;
  listproduct['image'] = object_image;
  listproduct['price_new'] = object_price_new;
  listproduct['price_old'] = object_price_old;
  listproduct['discount'] = object_discount;
  return listproduct;
}
function getTag(){
  var listTag = [];
  var object_name = [];
  var object_link = [];
  $.ajax({
    url: './ajax/getTag.php',
    type: 'POST',
    dataType: 'json',
    success: function(data){
      var list = data;
      var i=0;
      for(index in list){
        object_name[i] = list[index].name;
        object_link[i] = list[index].link;
        i++;
      }
    }
  });
  listTag['name'] = object_name;
  listTag['link'] = object_link;
  return listTag;
}
var product = getProduct();
var tag = getTag();

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
width = $(window).width();
if (width > 1310) {
    autocomplete(document.getElementsByClassName("search-box"), product, 'suggest_pc',tag,'sugget_tag_pc');
} else {
    autocomplete(document.getElementsByClassName("search-box"), product, 'suggest_mobile',tag,'sugget_tag_mb');
}