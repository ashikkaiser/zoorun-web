<select {{ $attributes }} class="select2 form-select upozilla-select" data-allow-clear="true"
    data-placeholder="Select Upazilla">
    <option value="">Select Upazilla</option>
</select>

@section('components.upazilla-select')
    <script>
        $(document).ready(function() {
            var pre_id = '{{ $attributes->get('pre_id') }}';
            var next_id = '{{ $attributes->get('next_id') }}';
            var id = '{{ $attributes->get('id') }}';
            $(pre_id).on('select2:select', function(e) {
                $('#' + id).empty().trigger('change');
                $(next_id).empty().trigger('change');
                var district = e.params.data.id;
                var url = `{{ route('admin.application.getzone') }}?district=${district}`;
                fetch(url)
                    .then(async res => await res.json())
                    .then(data => {
                        var defaultOption = new Option("", "", true, true);
                        $('#' + id).append(defaultOption).trigger('change');
                        data.map(item => {
                            var newOption = new Option(item.name, item.id, true, false);
                            $('#' + id).append(newOption).trigger('change');
                        })
                    }).catch(err => {
                        console.log(err)
                    })
            });


            $('#' + id).on('select2:select', function(e) {
                var upazilla = e.params.data.id;
                $(next_id).empty().trigger('change');
                fetch(`{{ route('admin.application.getarea') }}?zone=${upazilla}`)
                    .then(async res => await res.json())
                    .then(data => {
                        var defaultOption = new Option("", "", true, true);
                        $(next_id).append(defaultOption).trigger('change');
                        data.map(item => {
                            var newOption = new Option(item.name, item.id, true, false);
                            $(next_id).append(newOption).trigger('change');
                        })
                    }).catch(err => {
                        console.log(err)
                    })
            });
        });
    </script>
@endsection
