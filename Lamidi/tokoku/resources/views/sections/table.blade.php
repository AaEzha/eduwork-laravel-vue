<table class="table" width="100%">
    <thead>
        <tr>
            <th>Section Name</th>
            <th>Section Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sections as $section)
        <tr>
            <td>{{$section->section_name}}</td>
            <td>{{$section->status==1?'Enable':'Disabled'}}</td>
            <td>
                <div class="btn-group">
                    <a href="#" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </div>
            </td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>