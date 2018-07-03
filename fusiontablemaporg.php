<?php
?>

<!DOCTYPE html>
<html>
  <head>
  <style>
    #map-canvas { width:800px; height:600px;}
    .layer-wizard-search-label { font-family: sans-serif };
  </style>
  <script type="text/javascript"
    src="http://maps.google.com/maps/api/js?sensor=false">
  </script>
  <script type="text/javascript">
    var map;
    var layer_0;
    var layer_1;
    function initialize() {
      map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: new google.maps.LatLng(28.018259176506334, -82.3892022152504),
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      layer_0 = new google.maps.FusionTablesLayer({
        query: {
          select: "col5",
          from: "1N9yjGMeItbKRyAF9HL8Ad-6rxn2mpU3ZUy0PpFlH"
        },
        map: map,
        styleId: 2,
        templateId: 2
      });
      layer_1 = new google.maps.FusionTablesLayer({
        query: {
          select: "col2",
          from: "1F3tF49RpfRw1q0Z-FUNFRsHtEZm_55bFBBBj9Rhg"
        },
        map: map,
        styleId: 2,
        templateId: 2
      });
    }
    function changeMap_0() {
      var whereClause;
      var searchString = document.getElementById('search-string_0').value.replace(/'/g, "\\'");
      if (searchString != '--Select--') {
        whereClause = "'org_ID' = '" + searchString + "'";
      }
      layer_0.setOptions({
        query: {
          select: "col5",
          from: "1N9yjGMeItbKRyAF9HL8Ad-6rxn2mpU3ZUy0PpFlH",//fusion poly
          where: whereClause
        }
      })
      layer_1.setOptions({
        query: {
          select: "col2",
          from: "1F3tF49RpfRw1q0Z-FUNFRsHtEZm_55bFBBBj9Rhg",//fusion marker
          where: whereClause
        }
      });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  </head>
  <body>
    <div id="map-canvas"></div>
    <div style="margin-top: 10px;">
      <label class="layer-wizard-search-label">
        Org
        <select id="search-string_0" onchange="changeMap_0(this.value);">
          <option value="--Select--">--Select--</option>
          <option value="NaN">NaN</option>
          <option value="17">17</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="30">30</option>
          <option value="31">31</option>
          <option value="33">33</option>
          <option value="34">34</option>
          <option value="35">35</option>
          <option value="36">36</option>
          <option value="37">37</option>
          <option value="38">38</option>
          <option value="39">39</option>
          <option value="40">40</option>
          <option value="41">41</option>
          <option value="42">42</option>
          <option value="43">43</option>
          <option value="44">44</option>
          <option value="45">45</option>
          <option value="46">46</option>
          <option value="47">47</option>
          <option value="48">48</option>
          <option value="49">49</option>
          <option value="50">50</option>
          <option value="51">51</option>
          <option value="52">52</option>
          <option value="53">53</option>
          <option value="54">54</option>
          <option value="55">55</option>
          <option value="56">56</option>
          <option value="57">57</option>
          <option value="58">58</option>
          <option value="59">59</option>
          <option value="60">60</option>
          <option value="61">61</option>
          <option value="62">62</option>
          <option value="63">63</option>
          <option value="64">64</option>
          <option value="65">65</option>
          <option value="66">66</option>
          <option value="67">67</option>
          <option value="69">69</option>
          <option value="70">70</option>
          <option value="71">71</option>
          <option value="72">72</option>
          <option value="73">73</option>
          <option value="75">75</option>
          <option value="76">76</option>
          <option value="77">77</option>
          <option value="78">78</option>
          <option value="79">79</option>
          <option value="80">80</option>
          <option value="81">81</option>
          <option value="82">82</option>
          <option value="83">83</option>
          <option value="84">84</option>
          <option value="85">85</option>
          <option value="86">86</option>
          <option value="87">87</option>
          <option value="88">88</option>
        </select>
      </label> 
    </div>
  </body>
</html>
