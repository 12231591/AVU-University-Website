<div>
  <input id="question" placeholder="Ask a question..." />
  <button onclick="askAI()">Send</button>
</div>
<div id="response" style="margin-top:10px;"></div>

<script>
function askAI() {
    const question = document.getElementById("question").value;
    fetch("ask.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ question })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("response").innerHTML = data.answer;
    });
}
</script>
