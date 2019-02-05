<p>Hi,</p>

<p>
	We need your permission to keep your passport details to inform you in future when your passport is going to expire.
	If you are happy to proceed please give your consent by <a href="{{ route('confirm', $token) }}" class="btn btn-success ">clicking here.</a>
</p>
<p>
	If no, then <a href="{{route('deleteClientPassportData', $token)}}" class="btn btn-warning">click here</a> and we will remove your passport details.
</p>
