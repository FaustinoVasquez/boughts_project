<table>
    <tbody>
    @foreach($aliasesImport as $aliasImport)
        <tr>
            <td>{{$aliasImport->SKU}}</td>
            <td>{{$aliasImport->Alias}}</td>
            <td>{{$aliasImport->StoreName}}</td>
            <td>{{$aliasImport->Delete}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
