<footer class="dvFooters">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-6">
                        <ul class="list">
                            <li>Shop</li>
                            <li><a href="">Subscription</a></li>
                            <li><a href="">Value Packs</a></li>
                            <li><a href="">Juices</a></li>
                            <li><a href="">Almond Milks</a></li>
                            <li><a href="">Protein Milkshake</a></li>
                            <li><a href="">Cleanses</a></li>
                            <li><a href="">Bulk Order</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-5 border-right">
                        <ul class="list">
                            <li>Learn</li>
                            <li><a href="">Process</a></li>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">News</a></li>
                            <li><a href="">Beyond The Bottle</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="dvSignups col-sm-6">
                <div class="row">
                    <div class="col-12">
                        <h6>Sign-up to get closer</h6>
                    </div>
                    <div class="form col-12">
                        <input type="text" class="form-control" placeholder="Enter Email Id">
                        <button class="btn">Subscribe</button>
                    </div>
                    <div class="links col-12">
                        <div class="d-flex">
                            <a href="">Shop</a>
                            <a href="">Learn</a>
                            <a href="">Cleanse Guide</a>
                            <a href="">Contact</a>
                        </div>
                    </div>
                    <div class="col-12">
                        <h6>All Good. No Bad.</h6>
                    </div>
                    <div class="col-12">
                        <p>Raw Pressery makes fresh cold pressed juices and almond milks, delivered straight to your
                        doorstep.</p>
                        <p>
                            &copy; 2019 RAKYAN BEVERAGES
                        </p>
                        <p class="terms">
                            <a href="">Terms</a>
                            <a href="">Privacy Policy</a>
                            <a href="">Return &amp; Refund Policy</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- <script src="js/jquery.min.js"></script> -->
<script src="<?= ASSET_URL ?>js/jquery.js"></script>
<script src="<?= ASSET_URL ?>js/owl.carousel.min.js"></script>
<script src="<?= ASSET_URL ?>js/main-white.js"></script>
<script>
let btn1 = document.querySelector('.btn1');
let getButtons = document.querySelectorAll('.dvBottles .bottle .btn');
let modal = document.querySelector('#dvBottlesModal');
let closeBtn = document.querySelector('#dvBottlesModal.modal .close');
let body = document.querySelector('body');
let modalContent = document.querySelector('#dvBottlesModal .modal-content');
let text = document.querySelector('#dvBottlesModal .modal-content .text');
let txtObj = {
text1: `<h4>Caps</h4>
<p>All safe. No Leaks. Little leaks in caps can cause oxidation &amp; spoilage. Our new airtight caps protect the liquid inside from oxidation, leakag-es and contact with other external elements like air, water or dust.</p>`,
text2: `
<h4>Juice Inside</h4>
<p>All Fresh. No Preservatives. We use cutting-edge High-Pressure Sterilization Processes to keep our
    juices preservatives free. This advanced scientific process enables us to naturally preserve the
juices without adding any preservative or through any secret formula.</p>`,
text3: `<h4>Sedimentation</h4>
<p>All Natural. No artificial. pulp being heavier, settles down naturally. Don't worry, no artificial emulsifiers here. Just Shake &amp; Take.</p>`,
text4: `<h4>Plastic BPA</h4>
<p>All Protection. No fear. Did you know that UV rays from the sun are a strong catalyst in the oxidation of fruits and are a major reason behind them getting spoiled? Our new bottles come with invisible barrier lining that blocks UV light from entering the bottle and thereby protecting the juice &amp; keeping the nutrients intact.</p>`,
text5: 'not found'
}
Array.from(getButtons).forEach(function (buttons) {
buttons.addEventListener('click', function () {
modal.style.display = 'block';
modalContent.style.backgroundColor = 'black';
body.style.overflow = 'hidden';
let getAttr = buttons.getAttribute('class');
if (getAttr == 'btn btn1') {
text.innerHTML = txtObj.text1;
}
else if (getAttr == 'btn btn2') {
text.innerHTML = txtObj.text2;
}
else if (getAttr == 'btn btn3') {
text.innerHTML = txtObj.text3;
}
else if (getAttr == 'btn btn4') {
text.innerHTML = txtObj.text4;
}
else {
text.innerHTML = txtObj.text5;
}
});
});
closeBtn.onclick = function () {
modal.style.display = 'none';
body.style.overflow = 'unset';
}
</script>
</body>
</html>