package main
import (
	"fmt"
	"net/http"
)


type Test struct {
	Currency string
	OriginalValue string
}

func InitTest() *[]Test {
	var Tests = make([]Test,0)
	var  T1 Test
	T1.Currency = "UAH"
	T1.OriginalValue = "12"
	Tests = append(Tests,T1)
	T1.Currency = "GBP"
	T1.OriginalValue = "156"
	Tests = append(Tests,T1)
	T1.Currency = "EUR"
	T1.OriginalValue = "1000"
	Tests = append(Tests,T1)
	T1.Currency = "RUB"
	T1.OriginalValue = "11"
	Tests = append(Tests,T1)
	return &Tests
}


func main() {
	var Tests = InitTest()
	for _,task := range *Tests {
		getResponse(task.Currency,task.OriginalValue)
	}
	fmt.Scanf("\n")
}

func getResponse(Currency string, Value string ) {
    fmt.Println("Test: Currency= "+Currency+"  Original value= "+Value)
	resp, err := http.Get("https://presentable-post.000webhostapp.com/Convert.php?currency="+Currency+"&original_value="+Value)
	if err != nil {
		fmt.Println(err)
		return
	}
	defer resp.Body.Close()
	for true {

		bs := make([]byte, 1014)
		n, err := resp.Body.Read(bs)
		fmt.Println(string(bs[:n]))

		if n == 0 || err != nil{
			break
		}
	}
}