<a href="#" style="margin: 5px;" class="btn btn-danger" id="deleteselected">Delete Selected</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th><input type="checkbox" id="check_all"></th>
            <th>Section Name</th>
            <th>Section Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($sections->count())
        @foreach ($sections as $key => $section)
        <tr id="sid{{$section->id}}">
            <td><input type="checkbox" name="ids" class="checkboxclass" value="{{$section->id}}"></td>
            <td>{{$section->section_name}}</td>
            <td>{{$section->status==1?'Enable':'Disabled'}}</td>
            <td>
                <div class="btn-group">
                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editsection{{$section->id}}"> <i class=" fa fa-edit"></i>Edit</a>
                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletesection{{$section->id}}"> <i class=" fa fa-trash"></i>Delete</a>
                </div>
            </td>
        </tr>
        <!-- Modal of Edit section-->
        @include('sections.edit')
        <!-- Modal of Delete section-->
        @include('sections.delete')
        @endforeach
        @endif

    </tbody>
</table>
<script>
    $(function(e) {
        $("#check_all").click(function() {
            $(".checkboxclass").prop('checked', $(this).prop('checked'));
        });
        $("#deleteselected").click(function(e) {
            e.preventDefault();
            var allids = [];
            $("input:checkbox[name=ids]:checked").each(function() {
                allids.push($(this).val());
            });
            $.ajax({
                url: "{{route('deleteselected')}}",
                type: "DELETE",
                data: {
                    _token: $("input[name=_token]").val(),
                    ids: allids
                },
                success: function(response) {
                    $.each(allids, function(key, val) {
                        $("#sid" + val).remove();
                    })
                }
            })
        })
    });
</script>