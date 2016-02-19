<table id="titleTable">
	<tr>
		<td><h2>{stockname}</h2></td>
	</tr>
</table>
<div id="TableDiv">
    <div id="leftTableDiv">
        <table id="leftTable">
                <tr>
                    <td><h3>Timestamp</h3></td><td><h3>Up/Down</h3></td>
                </tr>
                
                {stockPriceHistory}
        </table>
    </div>
    <div id="rightTableDiv">
        <table id="rightTable" text-align="left">

                <tr>
                    <td><h3>Player</h3></td><td><h3>Amount</h3></td><td><h3>Timestamp</h3></td>
                </tr>
                
                {stocksHistoryQuery}
        </table>
    </div>
</div>