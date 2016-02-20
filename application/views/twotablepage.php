<!-- Two table layout for pages !-->

<table id="titleTable">
	<tr>
            <td><h2>{contentTitle} {dropdowndata}</h2></td>
	</tr>
</table>
<div id="TableDiv">
    <div id="leftTableDiv">
        <table id="leftTable">
                {leftTableColumns}                
                {leftTableQuery}
        </table>
    </div>
    <div id="rightTableDiv">
        <table id="rightTable" text-align="left">
                {rightTableColumns}
                {rightTableQuery}
        </table>
    </div>
</div>