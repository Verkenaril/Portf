@extends("app")
@section("content")
<div id="catalog__elem">
{{$data->name}}
    <table>
    @foreach($descr as $d)
    <tr><td>{{$d[0]}}</td><td>{{$d[1]}}</td></tr>


    @endforeach
    </table>
    <div class="spec-group">
        <div class="spec-title"></div> 
        <div class="spec-value">{{$d[1]}}</div> 
    </div>
</div>
@endsection

@section("partjs")
<script>

</script>
@endsection