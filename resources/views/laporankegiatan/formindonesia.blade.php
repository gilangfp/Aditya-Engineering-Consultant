@extends('templates.main')


@section('container')

<body>
    <div class="container">
        <h1 class='mt-5'>Indonesia</h1>
        <form class='mt-2'>
            <div class='mb-2'>
                <label> Departemen</label>
                <select id="selectdepartemen" class="form-select" aria-label="Default select example">

                </select>
            </div>

            <div class='mb-2'>
                <label> Sub Departemen</label>
                <select id="selectsub" class="form-select" aria-label="Default select example">

                </select>
            </div>

            <div class='mb-2'>
                <label> Jenis Kegiatan</label>
                <select id="selectjenis" class="form-select" aria-label="Default select example">

                </select>
            </div>

        </form>
    </div>
    <script>
        $(document).ready(function(){
            $("#selectProv").select2({
                placeholder:'Pilih Provinsi',
                ajax: {
                    url: "{{route('provinsi.index')}}",
                    processResults: function({data}){
                        return {
                            results: $.map(data, function(item){
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        }
                    }
                }
            });
            $("#selectProv").change(function(){
                let id = $('#selectProv').val();
                $("#selectRegenc").select2({
                placeholder:'Pilih Wilayah',
                ajax: {
                    url: "{{url('selectRegenc')}}/"+ id,
                    processResults: function({data}){
                        return {
                            results: $.map(data, function(item){
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        }
                    }
                }
            });
            });
        });
        </script>
</body>
@endsection