<tr>

	<td>1</td>
	<td>{{$vendor->full_name}}</td>
	<td>{{$vendor->phone}}</td>
	<td>123123</td>
	<td>{{$vendor->usedCoupons->first()->count}}</td>
	<td>{{$vendor->usedCoupons->first()->price_total}}</td>

</tr>