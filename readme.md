# README
laravelのqueueを練習してみた

### どんなアプリ？
todoを登録するとtodoテーブルにRecordが書かれる。
同時にtodo登録履歴管理用のtodo_historiesテーブルへの書き込みjobをqueueスタックする。
todo_historiesテーブルにはtodoの名前とtodoテーブルのidを書き込む。
書き込みはqueue:workでジョブ実行を行った際。


