<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Section Name</th>
            <th>Section Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sections as $key => $section)
        <tr>
            <td>{{$key+1}}</td>
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
    </tbody>
</table>