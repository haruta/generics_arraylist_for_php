generics_arraylist_for_php
==========================

Generics ArrayList For PHP

JavaのGenericsを真似てPHPで作成

Type Hinting を利用したかったのでそれぞれの型のArrayListはAbstractGenericsArrayListを継承するようにした。

指定以外の型が渡された時は InvalidArgumentTypeException がスローされる。

今のところ

- int
- float
- string
- bool
- array
- resource
- DateTime

を判別するものを準備した。

また、 is_xxxx で判別できない型は instanceof を利用してチェックしているので、

クラス、サブクラス、インターフェースでチェック可能(だと思う)

自分で XXXXArrayList を用意する場合は

AbstractGenericsArrayList を継承して
```
protected function getTarget();
```
を実装する。

getTargetメソッドのクラス名、インターフェース名はトップレベルのネームスペースから指定が必要。

自作のチェックをさらにしたい場合は AbstractGenericsArrayList の assert メソッドを上書きすることで自作のチェックを実装する。
