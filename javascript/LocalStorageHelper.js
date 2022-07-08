// Localstorage helper for javascript best practices
// sample code set value
// before: 
// {
//   level1: {
//     level2: {
//       level3: 'ok',
//       test: '1'
//     }
//   }
// }
// LocalStorageHelper.set('level1.level2.level3','test_value');
// after:
// {
//   level1: {
//     level2: {
//       level3: 'test_value'
//       test: '1'
//     }
//   }
// }
// LocalStorageHelper.get('level1.level2.level3','default_value');
// return test_value
const LocalStorageHelper = {
  set(key, value) {    
    if (key.includes(".")) {
      const treeKey = key.split(".")
      const parentKey = treeKey[0]
      treeKey.shift()
      let treeValue = this.getObject(parentKey)
      treeValue = this.__setArrayKeyToObject(treeKey, value, treeValue)
      return this.setObject(parentKey, treeValue);
    }
    return localStorage.setItem(key, value)
  },
  __setArrayKeyToObject(treeKey, value, beforeValue) {
    if (beforeValue === undefined || beforeValue === false) {
      beforeValue = {}
    }
    
    if (treeKey.length === 1) {
      beforeValue[treeKey[0]] = value
      return beforeValue
    } else {
      // array[key1][key2]
      const key1 = treeKey[0]
      treeKey.shift()
      beforeValue[key1] = this.__setArrayKeyToObject(treeKey, value, beforeValue[key1])
      return beforeValue
    }
  },
  get(key, defaultVal) {    
    if (key.includes(".")) {
      const treeKey = key.split(".")
      let treeValue = this.getObject(treeKey[0])
      treeKey.shift()
      let lengPoint = 1
      for (const i in treeKey) {
        if(treeValue === undefined || treeValue === null){
          return defaultVal
        }
        if (lengPoint === treeKey.length) {
          return treeValue[treeKey[i]]
        }
        treeValue = treeValue[treeKey[i]]
        lengPoint += 1
      }
    }
    const result = localStorage.getItem(key)
    if(result === undefined){
      return defaultVal
    }
    return result
  },
  getObject(key, defaultValue) {
    if (defaultValue === undefined) {
      defaultValue = {}
    }
    let result = this.get(key)
    if (result === undefined || result === null) {
      result = defaultValue
    } else {
      result = JSON.parse(result)
    }

    return result
  },
  setObject(key, value) {
    try {
      this.set(key, JSON.stringify(value));
    }
    catch (e) { localStorage.setItem(key, value); }
  },
  getArray(key, defaultValue) {
    if (defaultValue === undefined) {
      defaultValue = []
    }
    let result = this.get(key)
    if (result === undefined) {
      result = defaultValue
    } else {
      result = JSON.parse(result)
    }
    return result
  },
  remove(key) {
    localStorage.removeItem(key);
  }
}


export default LocalStorageHelper
