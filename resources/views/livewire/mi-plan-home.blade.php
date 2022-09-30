<div>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">PLAN ACTUAL</legend>
        
        <table class="table table-info table-hover">
            <thead>
                <tr>
                    <th scope="col">PLAN</th>
                    <th scope="col">DESDE</th>
                    <th scope="col">HASTA</th>
                    <th scope="col">VISTAS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $actual->plan->plan }}</td>
                    <td>{{ Carbon\Carbon::parse($actual->desde)->format('d-m-Y H:i') }}</td>
                    <td>{{ Carbon\Carbon::parse($actual->hasta)->format('d-m-Y H:i') }}</td>
                    <td>XXX</td>
                </tr>
            </tbody>
        </table>

    </fieldset>

    @if ( count($contratados) > 0 )			
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">PLANES CONTRATADOS</legend>
            
            <table class="table table-success table-hover">
                <thead>
                    <tr>
                        <th scope="col">PLAN</th>
                        <th scope="col">DESDE</th>
                        <th scope="col">HASTA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $contratados as $contratado )
                        <tr>
                            <td>{{ $contratado->plan->plan }}</td>
                            <td>{{ Carbon\Carbon::parse($contratado->desde)->format('d-m-Y H:i') }}</td>
                            <td>{{ Carbon\Carbon::parse($contratado->hasta)->format('d-m-Y H:i') }}</td>
                        </tr>                    
                    @endforeach
                </tbody>
            </table>

        </fieldset>        
    @endif

    @if ( count($vencidos) > 0 )			
        <fieldset class="scheduler-border">
            <legend class="scheduler-border">PLANES VENCIDOS</legend>
            
            <table class="table table-danger table-hover">
                <thead>
                    <tr>
                        <th scope="col">PLAN</th>
                        <th scope="col">DESDE</th>
                        <th scope="col">HASTA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $vencidos as $vencido )
                        <tr>
                            <td>{{ $vencido->plan->plan }}</td>
                            <td>{{ Carbon\Carbon::parse($vencido->desde)->format('d-m-Y H:i') }}</td>
                            <td>{{ Carbon\Carbon::parse($vencido->hasta)->format('d-m-Y H:i') }}</td>
                        </tr>                    
                    @endforeach
                </tbody>
            </table>

        </fieldset>        
    @endif

</div>
