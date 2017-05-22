<div class="row">
  <div class="col-sm-8">
    <h2>เกี่ยวกับเรา</h2>
    <div id="map" style="width:100%;height:400px;"></div>
    <script>
      function initMap() {
        var uluru = {lat: <?=$latt;?>, lng: <?=$longt;?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBC1HqMP74IoVLsfSuL54twrQlkCKH4gG4&callback=initMap"> </script>
  </div>
  <div class="col-sm-4">
    <h2>ติดต่อเรา</h2>
    <address>
      <strong>ที่อยู่</strong>
      <br>
      <?=$address;?>
    </address>
    <address>
      <abbr title="Phone">โทรศัพท์ : </abbr><?=$phone;?>
      <br>
      <abbr title="Email">อีเมล์ : </abbr><?=$email;?>
    </address>
  </div>
</div>
<hr>
