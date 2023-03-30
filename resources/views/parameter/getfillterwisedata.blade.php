<table id="myDataTable" class=" table-responsive table table-hover align-middle mb-0" >
    <tr>
        <th>No</th>
        <th>ParaId</th>
        <th>ParaDescription</th>
        
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        @foreach($MailParameterMaster as $d)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->ParaID}}</td>
                <td>{{$d->ParaDescription}}</td>

              
                <td>{{$d->Validity}}</td>
                
            </tr>
        @endforeach
    </tbody>
</table>