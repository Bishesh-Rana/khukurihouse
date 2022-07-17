@section('header')
<style>
  .this-one ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #f1f1f1;
  }

  .this-one ul li {
    float: left;
  }

  .this-one ul li a {
    display: block;
    color: #253544;
    text-align: center;
    padding: 16px;
    text-decoration: none;
  }

  .this-one ul li a:hover {
    background-color: #b4bcc8;
  }

  .this-one li ul li {
    display: none;
  }
</style>
@endsection
<div class="this-one">
  <ul>
    <li>
      <a href="{{route('seller.product.index')}}">All<p id="all-pro"></p></a>
    </li>
    <li><a href="{{route('seller.product.live')}}">Live<p id="live-pro"></p></a></li>
    <li><a href="{{route('seller.product.noimage')}}">Image Missing<p id="missing_image-pro"></p></a></li>
    <li class="active"><a href="{{route('seller.product.poorquality')}}">Poor Quality<p id="poor_quality-pro"></p></a>
      <ul>
        <li><a href="#about">one</a>
        <li><a href="#about">two</a>
      </ul>
    </li>
    <li><a href="{{route('seller.product.soldout')}}">Sold Out<p id="sold_out-pro"></p></a></li>
    <li><a href="{{route('seller.product.inactive')}}">Inactive<p id="inactive-pro"></p></a></li>
    <li><a href="{{route('seller.product.policyviolation')}}">Policy Violation<p id="policy_violation-pro"></p></a></li>
  </ul>
</div>

@section('footer-count')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>

<script>
  axios({
      method: 'get',
      url: 'api/productcount',
      baseURL: '/',
    })
    .then(response => {
      $("#all-pro").html(response.data.all);
      $("#live-pro").html(response.data.live);
      $("#missing_image-pro").html(response.data.missing_image);
      $("#poor_quality-pro").html(response.data.poor_quality);
      $("#sold_out-pro").html(response.data.sold_out);
      $("#inactive-pro").html(response.data.inactive);
      $("#policy_violation-pro").html(response.data.policy_violation);
    })
    .catch(error => {
      console.log(error);
    });
</script>
@endsection