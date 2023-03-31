<table id="myDataTable" class=" table-responsive table table-hover align-middle mb-0" >
    <tr>
        <th>No</th>
        <th>Parameter</th>
        <th>ParaFilter1</th>
        <th>ParaFilter2</th>
        <th>ParaCode</th>
        <th>ParaDescription</th>
        <th>ParaValue</th>
        <th>Validity</th>
    </tr>
    </thead>
    <tbody>
        @foreach($MailParameterMaster as $d)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->Parameter}}</td>
                <td>{{$d->ParaFilter1}}</td>
                <td>{{$d->ParaFilter2}}</td>
                <td>{{$d->ParaCode}}</td>
                <td>{{$d->ParaDescription}}</td>
                <td>{{$d->ParaValue}}</td>
                <td>{{$d->Validity}}</td>
                
            </tr>
        @endforeach
    </tbody>
</table>