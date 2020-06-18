<tr>

	<td>1</td>
	<td>{{$buyer->full_name}}</td>
	<td>{{$buyer->phone}}</td>
	<td>123123</td>
	<td>{{$buyer->usedCoupons->first()->count}}</td>
	<td>{{$buyer->usedCoupons->first()->price_total}}</td>

</tr>
