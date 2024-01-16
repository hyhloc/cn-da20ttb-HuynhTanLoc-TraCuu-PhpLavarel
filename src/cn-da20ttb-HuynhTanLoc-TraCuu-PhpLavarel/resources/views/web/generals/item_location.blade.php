@if(isset($data) && count($data)>0)
@foreach($data as $key => $item)
<div class="item-location">
	<div class="item-location__image">
		<div class="img">
			<a href="{{$item->getUrl()}}" target="_blank">
				<img src="{{$item->getThumnail()}}" alt="">
			</a>
		</div>
	</div>
	<div class="item-location__type">
		<span>Địa điểm</span>
	</div>
	<div class="item-location__info">
		<div class="name">
			<a href="{{$item->getUrl()}}" target="_blank">
				<h3>{{ $item->name??'' }}</h3>
			</a>
		</div>
		<div class="address">
			<p><i class="fa-solid fa-location-dot"></i> {{ $item->address??'' }}</p>
		</div>
		<div class="type">
			<p>{{ $item->category->name ?? '' }}<p>
		</div>
	</div>
</div>
<script>
	document.addEventListener("DOMContentLoaded", function() {
  var items = document.querySelectorAll(".item-location");

  function showItems() {
    items.forEach(function(item) {
      item.classList.add("show");
    });
  }

  // Add a small delay before showing the items
  setTimeout(showItems, 500); // Adjust the delay as needed
});

</script>
@endforeach
@endif