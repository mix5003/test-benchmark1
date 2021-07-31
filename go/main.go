package main

import (
	"fmt"
	"io/ioutil"
	"net/http"
	"strconv"
)

func fibo1(number int) int {
	if number <= 0 {
		return 0
	}

	if number < 2 {
		return 1
	}

	return fibo1(number-1) + fibo1(number-2)
}

func main() {
	http.HandleFunc("/hello", func(w http.ResponseWriter, req *http.Request) {
		w.Write([]byte("Hello World!"))
	})

	http.HandleFunc("/fibo1", func(w http.ResponseWriter, req *http.Request) {
		number, _ := strconv.Atoi(req.URL.Query().Get("number"))

		w.Write([]byte(strconv.Itoa(fibo1(number))))
	})

	http.HandleFunc("/fibo2", func(w http.ResponseWriter, req *http.Request) {
		number, _ := strconv.Atoi(req.URL.Query().Get("number"))

		result := 0

		if number <= 0 {
			result = 0
		} else if number < 2 {
			result = 1
		} else {
			count := number
			num1 := 0
			num2 := 1
			for i := 2; i <= count; i++ {
				result = num1 + num2
				num1 = num2
				num2 = result
			}

		}

		w.Write([]byte(strconv.Itoa(result)))
	})

	http.HandleFunc("/io", func(w http.ResponseWriter, req *http.Request) {
		resp, err := http.Get("http://nginx/index.html")
		if err != nil {
			fmt.Println(err)
		}
		defer resp.Body.Close()
		body, err := ioutil.ReadAll(resp.Body)

		w.Write([]byte(strconv.Itoa(len(body))))
	})

	http.ListenAndServe(":3000", nil)
}
