# phpproject
php, html, mysql 을 이용한 웹소설 사이트

사용자들이 자유롭게 유료,무료 소설을 등록하고 읽을 수 있는 웹소설 사이트 

<div>
<img width="300" alt="스크린샷 2020-04-15 오전 2 29 29" src="https://user-images.githubusercontent.com/39517457/79255674-a2013f00-7ec1-11ea-9ca4-141db948731b.png">
<img width="300" alt="스크린샷 2020-04-15 오전 2 31 23" src="https://user-images.githubusercontent.com/39517457/79255684-a9c0e380-7ec1-11ea-9aa5-aa3093724de2.png">
<img width="300" alt="스크린샷 2020-04-15 오전 2 31 37" src="https://user-images.githubusercontent.com/39517457/79255760-cd842980-7ec1-11ea-8fa3-d9b410a48f5c.png">

</div>
<div>
  <img width="300" alt="스크린샷 2020-04-15 오전 2 31 45" src="https://user-images.githubusercontent.com/39517457/79255769-cf4ded00-7ec1-11ea-8564-382d0a41b6e3.png">
  <img width="300" alt="스크린샷 2020-04-15 오전 2 32 01" src="https://user-images.githubusercontent.com/39517457/79255811-dffe6300-7ec1-11ea-9163-3bfdb405b8e8.png">
<img width="300" alt="스크린샷 2020-04-15 오전 2 32 22" src="https://user-images.githubusercontent.com/39517457/79255816-e260bd00-7ec1-11ea-8707-8fc44b94cb6b.png">
<img width="300" alt="스크린샷 2020-04-15 오전 2 38 36" src="https://user-images.githubusercontent.com/39517457/79256006-41263680-7ec2-11ea-864f-06e513db9146.png">
</div>


#### **구현 기능:** 
* 로그인,회원가입 - session을 통한 로그인 정보 유지
* 소설 등록 - 유료 또는 무료로 소설 등록
* 소설 조회수, 선호작 - 선호작품은 내선호작 페이지에서 모아보기 가능
* 소설 정렬 - 최신순, 조회수순, 선호작순으로 정렬가능
* 소설 읽기 - < , > 화살표 버튼으로 이전화 , 다음화 이동 가능
* 게시판 기능 - 자유 게시판에 글 작성 가능
* kakaopay 결제 기능 - kakaopay api를 통해 가상 결제 가능
* 유료 소설 구입 - 결제한 금액으로 유료 소설 구입 가능 , 유료 소설은 결제한 사람만 볼 수 있음
* 이벤트 팝업 - 첫 로그인 시 cookie를 활용한 이벤트 팝업창 기능 (24시간 동안 보지않을 수 있음) 

# Program Stacks
### **Client**  
* HTML ,CSS
* Bootstrap
  
### **Server**  
* PHP
* MySQL
* kakaopay API
