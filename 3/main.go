package main
import (
	"fmt"
	"strconv"
	"github.com/gin-gonic/gin/json"
	"time"
	"bufio"
	"os"
	"regexp"
)




func fibonacci(n int) int {
	F := [][]int{}

	row1 := []int{1, 1}
	row2 := []int{1, 0}

	// Прикрепляем в матрицу
	F = append(F, row1)
	F = append(F, row2)

	if n == 0 {
		return 0
	}
	power(F, n-1)

	return F[0][0]
}

/* Helper function that calculates F[][] raise to the power n and puts the
result in F[][]
Note that this function is designed only for fibonacci() and won't work as general
power function */
func power(F [][]int, n int) {

	M := [][]int{}
	// These are the first two rows.
	row1 := []int{1, 1}
	row2 := []int{1, 0}

	// Append each row to the two-dimensional slice.
	M = append(M, row1)
	M = append(M, row2)

	// n - 1 раз умножаем матрицы}
	for i := 2; i <= n; i++ {
		multiply(F, M)
	}
}

/* Умножение матрицы на матрицу и возвращение результирующей матрицы */
func multiply(F1 [][]int, F2 [][]int) {
	x := F1[0][0]*F2[0][0] + F1[0][1]*F2[1][0]
	y := F1[0][0]*F2[0][1] + F1[0][1]*F2[1][1]
	z := F1[1][0]*F2[0][0] + F1[1][1]*F2[1][0]
	w := F1[1][0]*F2[0][1] + F1[1][1]*F2[1][1]

	F1[0][0] = x
	F1[0][1] = y
	F1[1][0] = z
	F1[1][1] = w
}


func main() {


	var input int
	var i int
	err_arr := map[string]int{}
	var (
		true_res int
		false_res int
		temp string
		scanned bool
		scanner = bufio.NewScanner(os.Stdin)


		////messages = make(chan string)
		//done = make(chan bool)
		//finished = make(chan bool)

	)
	fmt.Println("Вам необходимо вводить последовательно числа Фибоначчи\nНа каждый ввод у Вас есть 10 секунд. Действие продолжается до 10 правильных ответов или 3-х ошибок")
	for i=0; ;i++ {
		input = -1
		scanned = false

		if true_res == 10 || false_res == 3 {
			fmt.Println("\nИгра окончена! Правильных ответов " + strconv.Itoa(true_res) + ", ошибок " + strconv.Itoa(false_res))
			return
		}
		fmt.Println("\nВведите число с порядковым номером " + strconv.Itoa(i) + ":")


		Result := func () {
			res := fibonacci(i)
			if res == input {
				fmt.Println("Отлично!")
				fmt.Print("\n")
				true_res++

			} else {
				err_arr["answer"] = res
				err_arr["position"] = i

				res, _ := json.Marshal(err_arr)
				fmt.Println("Правильный ответ:")
				fmt.Println(string(res))
				false_res++
			}

		}

		 go func () {
			for scanner.Scan() {
				var re = regexp.MustCompile(`[[:space:]]`)
				temp = scanner.Text()
				temp = re.ReplaceAllString(temp, "")
				if temp != "" {
					scanned = true
					input, _ = strconv.Atoi(temp)
					Result()
					return
				}
			}

				}()



		 Timer := func() {
			    for j:=0;j<10;j++ {
			    	if scanned {return}
					time.Sleep(1 * time.Second)
				}
				if !scanned {
					fmt.Print("Время вышло\n")
					Result()
				}
		}
		Timer()







	}

	// Чтобы не закрывалась сразу
	fmt.Scanf("%v",&input)
}
