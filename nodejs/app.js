const fetch = require('node-fetch');
const express = require('express')
const app = express()
const port = 3000

const fibo1 = (number) => {
    if(number <= 0) return 0;
    if(number < 2) return 1;

    return fibo1(number - 1) + fibo1(number - 2);
};

app.get('/hello', (req, res) => {
  res.send('Hello World!')
});

app.get('/fibo1', (req, res) => {
    res.send('' + fibo1(req.query.number || 0))
});

app.get('/fibo2', (req, res) => {
    let result = 0;

    if(req.query.number <= 0) {
        result = 0;
    }else if(req.query.number < 2) {
        result = 1;
    }else{
        let count = req.query.number || 0;
        let i, num1 = 0, num2 = 1;
        for (i = 2; i <= count; i++) {
            result = num1 + num2;
            num1 = num2;
            num2 = result;
        }

    }

    res.send('' + result)
});

app.get('/io', async (req, res) => {
    const apiRequest = await fetch("http://nginx/index.html");
    const text = await apiRequest.text();

    res.send('' + text.length)
});

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`)
})