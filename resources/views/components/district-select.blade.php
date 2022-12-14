<select {{ $attributes }} class="form-control select2">
    <option value="">Select District</option>
    @foreach ($districts as $district)
        <option value="{{ $district->id }}">{{ $district->name }}</option>
    @endforeach
</select>
@section('components.scripts')
    <script>
        $(document).ready(function() {
            var next_id = '{{ $attributes->get('next_id') }}';
            console.log(next_id);
            var id = '{{ $attributes->get('id') }}';
            if ({{ $districts->count() }} === 1) {
                $('#' + id).val({{ $districts->first()->id }});
                $('#' + id).trigger('change');
                // if (next_id) {
                //     $(next_id).empty().trigger('change');
                //     var upazilla = {{ $districts->first()->id }};
                //     var url = `{{ route('admin.application.getarea') }}?district=${upazilla}`;
                //     fetch(url)
                //         .then(async res => await res.json())
                //         .then(data => {
                //             var defaultOption = new Option("", "", true, true);
                //             $(next_id).append(defaultOption).trigger('change');
                //             data.map(item => {
                //                 var newOption = new Option(item.name, item.id, true, false);
                //                 $(next_id).append(newOption).trigger('change');
                //             })
                //         }).catch(err => {
                //             console.log(err)
                //         })

                // }
            }
            var upazilla = {{ $districts->first()->id }};
            $(next_id).select2({
                ajax: {
                    url: `{{ route('admin.application.getarea') }}?district=${upazilla}`,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1
                        }
                        return query;
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(item => {
                                return {
                                    id: item.id,
                                    text: item.name
                                }
                            })
                        }

                    },
                    cache: true,
                    minimumInputLength: 1,
                }
            });

        });
    </script>
@endsection
