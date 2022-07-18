<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style type="text/css">
    * {
        font-family: "DejaVu Sans Mono", monospace !important;
        font-size: 12px;

    }

    .uppercase {
        text-transform: uppercase
    }


    h1 {
        font-size: 1.5em;
        padding-bottom: 8px;
        border-bottom: 2px solid #ececec;
        width: 30%;
    }

    table, tr, th, td {
        text-align: left;
        padding: 2px 10px;
    }


    hr {
        border: 1px solid #ececec;

    }

</style>
<body>


<div>


    <h1> Curriculum Vitae</h1>


    <table>
        <tbody>
        <tr>
            <th>
                {{$user->full_name}}
            </th>
        </tr>
        <tr>
            <th>
                {{$user->profile->phone}}
            </th>
        </tr>
        <tr>
            <th>
                {{$user->email}}
            </th>
        </tr>
        <tr>
            <th>
                {{$user->profile->full_address}}
            </th>
        </tr>
        </tbody>

    </table>
    <hr>
    <table>
        <tbody>
        <thead class="  uppercase ">
        <tr>
            <th style="width: 200px">
                Education
            </th>
        </tr>
        </thead>
        @foreach($cv->education as $key => $education)
            <tr>
                <th >
                    {{$education->formated_date}}
                </th>
            </tr>
            <tr>
                <th>
                    Level
                </th>
                <td>
                    {{$education->degree}}

                </td>
            </tr>
            <tr>
                <th>
                    Institution, faculty, etc.
                </th>

                <td>
                    {{$education->institution . ', ' . $education->faculty}}
                </td>

            </tr>
            @if($education->speciality)
                <tr>
                    <th>
                        Specialization
                    </th>

                    <td>
                        {{$education->speciality}}

                    </td>
                </tr>
            @endif
            <tr>
                <th >
                    Description, achievements, etc.
                </th>

                <td>
                    {{$education->description}}

                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            @endforeach

            </tbody>

    </table>
    @if($cv->work->isNotEmpty())
        <hr>
        <table>
            <tbody>
            <thead class="uppercase ">
            <tr >
                <th  style="width: 200px;">
                    Work experience
                </th>
            </tr>
            </thead>
            @foreach($cv->work as $key => $work)
                <tr>
                    <th>
                        {{$work->formated_date}}
                    </th>
                </tr>
                <tr>
                    <th>
                        Employer
                    </th>
                    <td
                    >
                        {{$work->employer}}

                    </td>
                </tr>
                <tr>
                    <th>
                        Position
                    </th>
                    <td>
                        {{$work->position}}
                    </td>

                </tr>
                <tr>
                    <th>
                        Description, achievements, etc.
                    </th>
                    <td>
                        {{$work->description}}

                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                @endforeach

                </tbody>

        </table>
    @endif


</div>


</body>
</html>
