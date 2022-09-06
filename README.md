# 建置方法

## 本地安裝步驟

1. git clone 這個專案

2. 還原vendor目錄(必須安裝 composer)

``` powershell
  $ composer install
```

3. 安裝node.js (有用到Laravel Vite 需安裝)

``` powershell
  #檢查是否有安裝完成 皆須出現版本號
  $ node -v
  $ npm -v
```

4. 還原 node_modules 目錄

``` powershell
  $ npm install
```

5. 還原.env

``` powershell
  $ cp .env.example .env
  $ php artisan key:generate
  $ php artisan jwt:secret
```

6. 還原資料庫

``` powershell
  #請先安裝PostgreSQL並建立資料庫，進行migrate
  $ php artisan migrate
  #視需求塞資料，可以把設備整理好透過seeder匯入
  $ php artisan db:seed --class=seederFile
```

7. 執行

``` powershell
  #可即時預覽
  $ npm run dev
  #打包
  $ npm run build
```