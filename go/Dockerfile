FROM golang:1.16

WORKDIR /go/src/app
COPY . .

RUN go build main.go

EXPOSE 3000

CMD ["./main"]