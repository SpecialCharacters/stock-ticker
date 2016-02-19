<table id="titleTable">
	<tr>
            <td><h2>{playername} {dropdowndata}</h2></td>
	</tr>
</table>
<div id="TableDiv">
    <div id="leftTableDiv">
        <table id="leftTable">
                <tr>
                    <td><h3>Name</h3></td><td><h3>Amount</h3></td>
                </tr>
                
                {stocksOwnedQuery}
        </table>
    </div>
    <div id="rightTableDiv">
        <table id="rightTable" text-align="left">

                <tr>
                    <td><h3>Stock</h3></td><td><h3>Amount</h3></td><td><h3>Timestamp</h3></td>
                </tr>
                {stocksHistoryQuery}
        </table>
    </div>
</div>