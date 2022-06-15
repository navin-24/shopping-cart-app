<div id="dvReviews" class="row">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Reviews</h3>
            </div>
            <?php
            if ($product_reviews) {
                ?>
                <div class="col-sm-12">
                    <div class="owl-carousel">
                        <?php
                        foreach ($product_reviews as $revw) {
                            ?>
                            <div class="item" itemprop="review" itemscope itemtype="http://schema.org/Review">
                                <img width="50" class="img-fluid" src="<?= ASSET_URL ?>imgs/productreview/<?= $revw['review_image']; ?>" alt="">
                                <div class="ratings" itemprop="ratingValue">
                                    <?php
                                    for ($j = 1; $j <= 5; $j++) {
                                        $cls2 = ($j <= $revw['review_rating']) ? 'fas' : 'far';
                                        echo ' <i class="' . $cls2 . ' fa-star"></i>';
                                    }
                                    ?>
                                </div>
                                <h5 itemprop="author"><?= $revw['user_name']; ?></h5>
                                <p itemprop="description">
                                    <?= $revw['review_comment']; ?>
                                </p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </div>
                <?php
            }
            ?>
<!--            <div class="col-sm-12">
                <p>
                    <b>Love it? Rate it?</b>
                </p>
                <button id="writeBtn" class="btn btnPrimary">Write a Review</button>
            </div>-->
        </div>
    </div>
</div>

<div id="myModal2" class="dvModal">
    <div id="reviewModal" class="modal" style="display:none;">
        <div class="modal-content">                            
            <div class="row">
                <i class="fas fa-times-circle btn close"></i>
                <div class="col-sm-12 mb15 text-center">
                    <h4>Write a Review</h4>
                </div>
                <div class="col-sm-12 mb15">
                    <div class="custom-select">
                      <select>
                        <option value="0">Select Products:</option>
                        <option value="1">Audi</option>
                        <option value="2">BMW</option>
                        <option value="3">Citroen</option>
                        <option value="4">Ford</option>
                        <option value="5">Honda</option>
                        <option value="6">Jaguar</option>
                        <option value="7">Land Rover</option>
                        <option value="8">Mercedes</option>
                        <option value="9">Mini</option>
                        <option value="10">Nissan</option>
                        <option value="11">Toyota</option>
                        <option value="12">Volvo</option>
                      </select>
                    </div>
                    <p class="text-red text-center">require fill this field please</p>
                 <!-- <input list="products" name="products" placeholder="Select Product" class="form-control">
                    <datalist id="products">
                        <option value="Valencia Orange">
                        </option><option value="Cleanse">
                        </option><option value="Love">
                        </option><option value="Flush">
                        </option><option value="Pomogranate">
                        </option><option value="Mango">
                        </option><option value="Trim">
                        </option><option value="Lean">
                        </option><option value="Pineapple">
                        </option><option value="Glow">
                        </option><option value="Aloevera Lemonade">
                        </option><option value="Shield">
                        </option><option value="Watermelon">
                        </option><option value="Almond Milk Unsweetened">
                        </option><option value="Coconut Water">
                        </option><option value="Mixed Fruit">
                        </option><option value="Guava">
                        </option><option value="Grapefruit">
                        </option><option value="Protein Milkshake">
                        </option><option value="Almond Milk Coffee">
                    </option></datalist> -->
                </div>
                <div class="col-sm-12 mb15">
                    <input type="text" class="form-control" placeholder="Your Full Name">
                    <p class="text-red text-center">require fill this field please</p>
                </div>
                <div class="col-sm-12 mb15">
                    <textarea name="" id="" rows="5" class="form-control" placeholder="Write your review about the product."></textarea>
                    <p class="text-red text-center">require fill this field please</p>
                </div>
                <div class="col-sm-12 mb15 text-center">
                    <div class="upload-btn-wrapper">
                      <button class="btn"><i class="fas fa-upload"></i> Upload an Image</button>
                      <input type="file" name="myfile" />
                      <p class="text-red text-center">jpg, png only. max size 1mb</p>
                    </div>
                </div>
                <div class="col-sm-12 mb15">
                    <div class="d-flex justify-content-center">
                        <div>Rate it. </div>
                        <div class="star-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>                                    
                <div class="col-sm-12 text-center">
                    <button class="btn btnSecondary">Submit Review</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);


    // var reviewModal = document.getElementById("reviewModal");
    // var writeBtn = document.getElementById("writeBtn");
    // var span4 = reviewModal.getElementsByClassName("close")[0];
    // writeBtn.onclick = function () {
    //     reviewModal.style.display = "block";
    // }
    // span4.onclick = function () {
    //     reviewModal.style.display = "none";
    // }
    // window.onclick = function (event) {
    //     if (event.target == modal2) {
    //         modal2.style.display = "none";
    //     }
    //     if (event.target == reviewModal) {
    //         reviewModal.style.display = "none";
    //     }
    // }
</script>