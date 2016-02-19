<table id="titleTable">
	<tr>
		<td><h2>Stocks</h2></td>
		<td><h2>Players</h2></td>
	</tr>
</table>
<div id="TableDiv">
    <div id="leftTableDiv">
        <table id="leftTable">
            <tr>
                <td><h3>Name</h3></td><td><h3>Code</h3></td><td><h3>Value</h3></td>
            </tr>
            {stocksQuery}
        </table>
    </div>
    <div id="rightTableDiv">
        <table id="rightTable" text-align="left">

                <tr>
                        <td><h3>Name</h3></td><td><h3>Equity</h3></td><td><h3>Cash</h3></td>
                </tr>

                {playersQuery}
        </table>
    </div>
</div>
